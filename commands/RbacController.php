<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\DbManager;

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
}
?>