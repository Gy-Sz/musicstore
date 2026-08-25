<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\DbManager;
use app\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        if (!$auth instanceof DbManager) {
            $this->stdout("Error: authManager must be DbManager.\n");
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // Admin role
        $adminRole = $auth->createRole('admin');
        $auth->add($auth->createRole('admin'));

        // Permissions példa
        $managePosts = $auth->createPermission('@managePosts');
        $managePosts->description = 'Manage posts';
        $auth->add($managePosts);

        // Admin kapja meg
        $auth->addChild($adminRole, $managePosts);
        $auth->assign($adminRole, 1); // 1 = admin user ID

        return ExitCode::OK;
    }

    public function actionAssign($roleName, $username)
    {
        $auth = Yii::$app->authManager;
        $user = User::find()->where(['username' => $username])->one();
        
        if (!$user) {
            $this->stdout("User not found: $username\n");
            return ExitCode::ERROR;
        }
        
        $role = $auth->getRole($roleName);
        if (!$role) {
            $this->stdout("Role not found: $roleName\n");
            return ExitCode::ERROR;
        }
        
        $auth->assign($role, $user->id);
        $this->stdout("Role '$roleName' assigned to user '$username'\n");
        return ExitCode::OK;
    }
}
?>