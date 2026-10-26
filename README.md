Az oldal egy zenebolt belső katalógus, termék és rendeléskezelő rendszere.
A felhasználói kört a bolt alkalmazottai képzik.

# Adatbázis
Az általam tesztelésre használt adatbázist a tartalmával együtt a musicstore.sql fájlba exportáltam.

## Táblák
- **artists**: a katalógusban regisztrált előadók listája
- **releases**: a katalógusban szereplő kiadások (ezek lehetnek albumok, kislemezek, stb)
- **products**: megvásárolható termékek, kiadások egy adott formátumban
- **prices**: árkatalógus, kapcsolódó termékazonosítóval és érvényességi dátumokkal
- **orders**: egy rendelés "fejléce"
- **order-items**: egy megrendelésen belüli termékek listája, a megvásárláskor fizetendő összeg itt is rögzítésre kerül
- **customers**: a bolt vásárlói

Egyéb táblák a felhasználók bejelentkeztetését kezelik.

# Használat
Az olal először a bejelentkező képernyőre vezet, bejelentkezés után válnak elérhetővé az egyes opciók.

Tesztelésre használt felhasználók:
- Username: "admin", Password: "admin"
- Username: "staff", Password: "staff"

## Katalóguskezelés
Az *Artists* és *Releases* menüpontok.
Egy kiadás felvitelekor lehetőség van kereshető listából kiválasztani előadót, egyszerű legördülő listából kiadástípust.

## Termékkezelés
Kiadás kiválasztására az előadó neve és a kiadás címe alapján van lehetőség.

## Rendeléskezelés
A rendelések egy rendelés státusz alapján rendezett kanban táblán láthatóak. A kártyákon lévő opciók segítségével lehet a rendelés fejlécét vagy a rendelésben szereplő termékek listáját módosítani.
Egy termék felvételekor lehetőség van egyedi ár és pénznem rögzítésére. A mezőket üresen hagyva (amennyiben lehetséges) a rendelés dátuma alapján lesz az ár kikeresve a *prices* táblából.

## 'Maintanance' szekció
Itt az adatbázisban szereplő típus és státusztáblák kezelésére van lehetőség, arra az esetre, ha új kiadástípus vagy termékformátum felvételére lenne szükség.