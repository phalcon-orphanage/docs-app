---
layout: default
language: 'cs-cz'
---
![](/assets/images/document-status-stable-success.svg) ![](/assets/images/version-{{ pageVersion }}.svg)
<a name='overview'></a>

# Instalace: WAMP

[WampServer](https://www.wampserver.com/en/) je vývojové prostředí pro web pro Windows. Umožňuje vám vytvářet webové aplikace běžící na Apache2, PHP a MySQL databázi. Níže jsou podrobné informace jak nainstalovat Phalcon framework na WampServer pro Windows. Použití nejnovější verze WampServeru je vysoce doporučeno.

<a name='phalcon'></a>

## Download the right version of Phalcon

WAMP has both 32 and 64 bit versions. From the download section, you can download the Phalcon DLL that suits your WAMPP installation.

Po stažení knihovny Phalcon frameworku budete mít ZIP soubor podobný ukázanému níže:

![](/assets/images/content/webserver-xampp-1.png)

Extrahujte knihovnu z archivu a budete mít Phalcon framework jako DLL soubor:

![](/assets/images/content/webserver-xampp-2.png)

Zkopírujte soubor `php_phalcon.dll` do adresáře kde máte rozšíření pro PHP. If WAMP is installed in the `C:\wamp` folder, the extension needs to be in `C:\wamp\bin\php\php5.5.12\ext` (assuming your WAMP installation installed PHP 5.5.12).

![](/assets/images/content/webserver-wamp-1.png)

Edit the `php.ini` file, it is located at `C:\wamp\bin\php\php5.5.12\php.ini`. Soubor může být upraven v libovolném textovém editoru. My doporučujeme použít Notepad++ pro předejití problémů s konci řádků a kódováním. Přidejte následující řádek na konec souboru:

extension=php_phalcon.dll

    <br />a uložte soubor.
    
    ![](/assets/images/content/webserver-wamp-2.png)
    
    Also edit the `php.ini` file, which is located at `C:\wamp\bin\apache\apache2.4.9\bin\php.ini`. Přidejte následující řádek na konec souboru: 
    
    extension=php_phalcon.dll 
    

and save it.

Restart the Apache Web Server. Do a single click on the WampServer icon at system tray. Choose `Restart All Services` from the pop-up menu. Check out that tray icon will become green again.

![](/assets/images/content/webserver-wamp-3.png)

Open your browser to navigate to http://localhost. The WAMP welcome page will appear. Check the section `extensions loaded` to ensure that phalcon was loaded.

![](/assets/images/content/webserver-wamp-4.png)

Congratulations! You are now phlying with Phalcon.

<a name='related'></a>

## Související průvodci

* [General Installation](/3.4/en/installation)
* [Instalace: XAMPP](/3.4/en/webserver-xampp)
