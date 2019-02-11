<?php

/*
    LambdaTest selenium automation sample example
    Configuration
    ----------
    username: Username can be found at automation dashboard
    accessToken:  AccessToken can be generated from automation dashboard or profile section

    Result
    -------
    Execute PHP Automation Tests on LambdaTest Distributed Selenium Grid
*/

require 'vendor/autoload.php';

class MagentoLambdaTest {
    /*
        Setup remote driver
        Params
        ----------
        platform : Supported platform - (Windows 10, Windows 8.1, Windows 8, Windows 7, macOS High Sierra, macOS Sierra, OS X El Capitan, OS X Yosemite, OS X Mavericks)
        browserName : Supported platform - (chrome, firefox, Internet Explorer, MicrosoftEdge, Safari)
        version :  Supported list of version can be found at https://www.lambdatest.com/capabilities-generator/
    */
    protected static $driver;

    public function visitMagentoStorefront() {
        # username: Username can be found at automation dashboard
        $LT_USERNAME = "[LAMBDA_USERNAME]";

        # accessKey:  AccessKey can be generated from automation dashboard or profile section
        $LT_APPKEY = "[LAMBDA_API_KEY]";

        $LT_BROWSER = "chrome";
        $LT_BROWSER_VERSION ="63.0";
        $LT_PLATFORM = "windows 10";

        # URL: https://{username}:{accessToken}@beta-hub.lambdatest.com/wd/hub
        $url = "https://". $LT_USERNAME .":" . $LT_APPKEY ."@hub.lambdatest.com/wd/hub";

        # setting desired capabilities for the test
        $desired_capabilities = new DesiredCapabilities();
        $desired_capabilities->setCapability('browserName',$LT_BROWSER);
        $desired_capabilities->setCapability('version', $LT_BROWSER_VERSION);
        $desired_capabilities->setCapability('platform', $LT_PLATFORM);
        $desired_capabilities->setCapability('name', "Php");
        $desired_capabilities->setCapability('build', "Php Build");
        $desired_capabilities->setCapability('network', true);
        $desired_capabilities->setCapability('visual', true);
        $desired_capabilities->setCapability('video ', true);
        $desired_capabilities->setCapability('console', true);
        $desired_capabilities->setCapability('tunnel', true);

        /*
            Setup remote driver
            Params
            ----------
            Execute test:  navigate google.com search LambdaTest
            Result
            -------
            print title
        */
        self::$driver = RemoteWebDriver::create($url, $desired_capabilities);

        self::$driver->get("http://www.magento2ce.local/admin");

        $username = self::$driver->findElement(WebDriverBy::id("username"));
        $password = self::$driver->findElement(WebDriverBy::id("login"));
        $signIn   = self::$driver->findElement(WebDriverBy::className("action-login"));

        $username->sendKeys("admin");
        $password->sendKeys("123123q");

        $signIn->submit();

        print self::$driver->getTitle();
        self::$driver->quit();
    }
}

$lambdaTest = new MagentoLambdaTest();
$lambdaTest->visitMagentoStorefront();