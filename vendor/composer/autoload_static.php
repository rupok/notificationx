<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89ec86686dc155609d949b902a87bbd5
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PriyoMukul\\WPNotice\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PriyoMukul\\WPNotice\\' => 
        array (
            0 => __DIR__ . '/..' . '/priyomukul/wp-notice/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'NotificationX\\Admin\\Admin' => __DIR__ . '/../..' . '/includes/Admin/Admin.php',
        'NotificationX\\Admin\\Cron' => __DIR__ . '/../..' . '/includes/Admin/Cron.php',
        'NotificationX\\Admin\\DashboardWidget' => __DIR__ . '/../..' . '/includes/Admin/DashboardWidget.php',
        'NotificationX\\Admin\\Entries' => __DIR__ . '/../..' . '/includes/Admin/Entries.php',
        'NotificationX\\Admin\\ImportExport' => __DIR__ . '/../..' . '/includes/Admin/ImportExport.php',
        'NotificationX\\Admin\\Notice' => __DIR__ . '/../..' . '/includes/Admin/Notice.php',
        'NotificationX\\Admin\\PluginInsights' => __DIR__ . '/../..' . '/includes/Admin/PluginInsights.php',
        'NotificationX\\Admin\\Reports\\EmailTemplate' => __DIR__ . '/../..' . '/includes/Admin/Reports/EmailTemplate.php',
        'NotificationX\\Admin\\Reports\\ReportEmail' => __DIR__ . '/../..' . '/includes/Admin/Reports/ReportEmail.php',
        'NotificationX\\Admin\\Settings' => __DIR__ . '/../..' . '/includes/Admin/Settings.php',
        'NotificationX\\Admin\\XSS' => __DIR__ . '/../..' . '/includes/Admin/XSS.php',
        'NotificationX\\Blocks\\Blocks' => __DIR__ . '/../..' . '/blocks/Blocks.php',
        'NotificationX\\Blocks\\StyleHandler' => __DIR__ . '/../..' . '/blocks/style-handler/style-handler.php',
        'NotificationX\\CoreInstaller' => __DIR__ . '/../..' . '/includes/CoreInstaller.php',
        'NotificationX\\Core\\Ajax' => __DIR__ . '/../..' . '/includes/Core/Ajax.php',
        'NotificationX\\Core\\Analytics' => __DIR__ . '/../..' . '/includes/Core/Analytics.php',
        'NotificationX\\Core\\Database' => __DIR__ . '/../..' . '/includes/Core/Database.php',
        'NotificationX\\Core\\GetData' => __DIR__ . '/../..' . '/includes/Core/GetData.php',
        'NotificationX\\Core\\Helper' => __DIR__ . '/../..' . '/includes/Core/Helper.php',
        'NotificationX\\Core\\Inline' => __DIR__ . '/../..' . '/includes/Features/Inline.php',
        'NotificationX\\Core\\Limiter' => __DIR__ . '/../..' . '/includes/Core/Limiter.php',
        'NotificationX\\Core\\Locations' => __DIR__ . '/../..' . '/includes/Core/Locations.php',
        'NotificationX\\Core\\Migration' => __DIR__ . '/../..' . '/includes/Core/Migration.php',
        'NotificationX\\Core\\Modules' => __DIR__ . '/../..' . '/includes/Core/Modules.php',
        'NotificationX\\Core\\PostType' => __DIR__ . '/../..' . '/includes/Core/PostType.php',
        'NotificationX\\Core\\QuickBuild' => __DIR__ . '/../..' . '/includes/Core/QuickBuild.php',
        'NotificationX\\Core\\REST' => __DIR__ . '/../..' . '/includes/Core/REST.php',
        'NotificationX\\Core\\Rest\\Analytics' => __DIR__ . '/../..' . '/includes/Core/Rest/Analytics.php',
        'NotificationX\\Core\\Rest\\BulkAction' => __DIR__ . '/../..' . '/includes/Core/Rest/BulkAction.php',
        'NotificationX\\Core\\Rest\\Entries' => __DIR__ . '/../..' . '/includes/Core/Rest/Entries.php',
        'NotificationX\\Core\\Rest\\Integration' => __DIR__ . '/../..' . '/includes/Core/Rest/Integration.php',
        'NotificationX\\Core\\Rest\\Posts' => __DIR__ . '/../..' . '/includes/Core/Rest/Posts.php',
        'NotificationX\\Core\\Rule' => __DIR__ . '/../..' . '/includes/Core/Rule.php',
        'NotificationX\\Core\\Rules' => __DIR__ . '/../..' . '/includes/Core/Rules.php',
        'NotificationX\\Core\\ShortcodeInline' => __DIR__ . '/../..' . '/includes/Features/ShortcodeInline.php',
        'NotificationX\\Core\\Upgrader' => __DIR__ . '/../..' . '/includes/Core/Upgrader.php',
        'NotificationX\\Core\\WPDRoleManagement' => __DIR__ . '/../..' . '/includes/Core/WPDRoleManagement.php',
        'NotificationX\\Extensions\\CF7\\CF7' => __DIR__ . '/../..' . '/includes/Extensions/CF7/CF7.php',
        'NotificationX\\Extensions\\ConvertKit\\ConvertKit' => __DIR__ . '/../..' . '/includes/Extensions/ConvertKit/ConvertKit.php',
        'NotificationX\\Extensions\\CustomNotification\\CustomNotification' => __DIR__ . '/../..' . '/includes/Extensions/CustomNotification/CustomNotification.php',
        'NotificationX\\Extensions\\CustomNotification\\CustomNotificationConversions' => __DIR__ . '/../..' . '/includes/Extensions/CustomNotification/CustomNotificationConversions.php',
        'NotificationX\\Extensions\\EDD\\EDD' => __DIR__ . '/../..' . '/includes/Extensions/EDD/EDD.php',
        'NotificationX\\Extensions\\EDD\\EDDInline' => __DIR__ . '/../..' . '/includes/Extensions/EDD/EDInline.php',
        'NotificationX\\Extensions\\Elementor\\From' => __DIR__ . '/../..' . '/includes/Extensions/Elementor/From.php',
        'NotificationX\\Extensions\\Envato\\Envato' => __DIR__ . '/../..' . '/includes/Extensions/Envato/Envato.php',
        'NotificationX\\Extensions\\Extension' => __DIR__ . '/../..' . '/includes/Extensions/Extension.php',
        'NotificationX\\Extensions\\ExtensionFactory' => __DIR__ . '/../..' . '/includes/Extensions/ExtensionFactory.php',
        'NotificationX\\Extensions\\FlashingTab\\FlashingTab' => __DIR__ . '/../..' . '/includes/Extensions/FlashingTab/FlashingTab.php',
        'NotificationX\\Extensions\\FluentForm\\FluentForm' => __DIR__ . '/../..' . '/includes/Extensions/FluentForm/FluentForm.php',
        'NotificationX\\Extensions\\Freemius\\Freemius' => __DIR__ . '/../..' . '/includes/Extensions/Freemius/Freemius.php',
        'NotificationX\\Extensions\\Freemius\\FreemiusConversions' => __DIR__ . '/../..' . '/includes/Extensions/Freemius/FreemiusConversions.php',
        'NotificationX\\Extensions\\Freemius\\FreemiusReviews' => __DIR__ . '/../..' . '/includes/Extensions/Freemius/FreemiusReviews.php',
        'NotificationX\\Extensions\\Freemius\\FreemiusStats' => __DIR__ . '/../..' . '/includes/Extensions/Freemius/FreemiusStats.php',
        'NotificationX\\Extensions\\GRVF\\GravityForms' => __DIR__ . '/../..' . '/includes/Extensions/GRVF/GravityForms.php',
        'NotificationX\\Extensions\\Give\\Give' => __DIR__ . '/../..' . '/includes/Extensions/Give/Give.php',
        'NotificationX\\Extensions\\GlobalFields' => __DIR__ . '/../..' . '/includes/Extensions/GlobalFields.php',
        'NotificationX\\Extensions\\Google\\GoogleReviews' => __DIR__ . '/../..' . '/includes/Extensions/Google/GoogleReviews.php',
        'NotificationX\\Extensions\\Google\\YouTube' => __DIR__ . '/../..' . '/includes/Extensions/Google/YouTube.php',
        'NotificationX\\Extensions\\Google_Analytics\\Google_Analytics' => __DIR__ . '/../..' . '/includes/Extensions/Google/Google_Analytics.php',
        'NotificationX\\Extensions\\IFTTT\\IFTTT' => __DIR__ . '/../..' . '/includes/Extensions/IFTTT/IFTTT.php',
        'NotificationX\\Extensions\\LearnDash\\LearnDash' => __DIR__ . '/../..' . '/includes/Extensions/LearnDash/LearnDash.php',
        'NotificationX\\Extensions\\LearnDash\\LearnDashInline' => __DIR__ . '/../..' . '/includes/Extensions/LearnDash/LearnDashInline.php',
        'NotificationX\\Extensions\\MailChimp\\MailChimp' => __DIR__ . '/../..' . '/includes/Extensions/MailChimp/MailChimp.php',
        'NotificationX\\Extensions\\NJF\\NinjaForms' => __DIR__ . '/../..' . '/includes/Extensions/NJF/NinjaForms.php',
        'NotificationX\\Extensions\\PressBar\\Importer' => __DIR__ . '/../..' . '/includes/Extensions/PressBar/importer.php',
        'NotificationX\\Extensions\\PressBar\\PressBar' => __DIR__ . '/../..' . '/includes/Extensions/PressBar/PressBar.php',
        'NotificationX\\Extensions\\ReviewX\\ReviewX' => __DIR__ . '/../..' . '/includes/Extensions/ReviewX/ReviewX.php',
        'NotificationX\\Extensions\\SureCart\\SureCart' => __DIR__ . '/../..' . '/includes/Extensions/SureCart/SureCart.php',
        'NotificationX\\Extensions\\Tutor\\Tutor' => __DIR__ . '/../..' . '/includes/Extensions/Tutor/Tutor.php',
        'NotificationX\\Extensions\\Tutor\\TutorInline' => __DIR__ . '/../..' . '/includes/Extensions/Tutor/TutorInline.php',
        'NotificationX\\Extensions\\Vimeo\\Vimeo' => __DIR__ . '/../..' . '/includes/Extensions/Vimeo/Vimeo.php',
        'NotificationX\\Extensions\\WPF\\WPForms' => __DIR__ . '/../..' . '/includes/Extensions/WPF/WPForms.php',
        'NotificationX\\Extensions\\Wistia\\Wistia' => __DIR__ . '/../..' . '/includes/Extensions/Wistia/Wistia.php',
        'NotificationX\\Extensions\\WooCommerce\\Woo' => __DIR__ . '/../..' . '/includes/Extensions/WooCommerce/Woo.php',
        'NotificationX\\Extensions\\WooCommerce\\WooCommerce' => __DIR__ . '/../..' . '/includes/Extensions/WooCommerce/WooCommerce.php',
        'NotificationX\\Extensions\\WooCommerce\\WooCommerceSales' => __DIR__ . '/../..' . '/includes/Extensions/WooCommerce/WooCommerceSales.php',
        'NotificationX\\Extensions\\WooCommerce\\WooInline' => __DIR__ . '/../..' . '/includes/Extensions/WooCommerce/WooInline.php',
        'NotificationX\\Extensions\\WooCommerce\\WooReviews' => __DIR__ . '/../..' . '/includes/Extensions/WooCommerce/WOOReviews.php',
        'NotificationX\\Extensions\\WordPress\\WPComments' => __DIR__ . '/../..' . '/includes/Extensions/WordPress/WPComments.php',
        'NotificationX\\Extensions\\WordPress\\WPOrgReview' => __DIR__ . '/../..' . '/includes/Extensions/WordPress/WPOrgReview.php',
        'NotificationX\\Extensions\\WordPress\\WPOrgStats' => __DIR__ . '/../..' . '/includes/Extensions/WordPress/WPOrgStats.php',
        'NotificationX\\Extensions\\WordPress\\WPOrg_Helper' => __DIR__ . '/../..' . '/includes/Extensions/WordPress/WPOrg_Helper.php',
        'NotificationX\\Extensions\\WordPress\\WordPress' => __DIR__ . '/../..' . '/includes/Extensions/WordPress/Wordpress.php',
        'NotificationX\\Extensions\\Zapier\\Zapier' => __DIR__ . '/../..' . '/includes/Extensions/Zapier/Zapier.php',
        'NotificationX\\Extensions\\Zapier\\ZapierConversions' => __DIR__ . '/../..' . '/includes/Extensions/Zapier/ZapierConversions.php',
        'NotificationX\\Extensions\\Zapier\\ZapierEmailSubscription' => __DIR__ . '/../..' . '/includes/Extensions/Zapier/ZapierEmailSubscription.php',
        'NotificationX\\Extensions\\Zapier\\ZapierReviews' => __DIR__ . '/../..' . '/includes/Extensions/Zapier/ZapierReviews.php',
        'NotificationX\\FrontEnd\\FrontEnd' => __DIR__ . '/../..' . '/includes/FrontEnd/FrontEnd.php',
        'NotificationX\\FrontEnd\\Preview' => __DIR__ . '/../..' . '/includes/FrontEnd/Preview.php',
        'NotificationX\\GetInstance' => __DIR__ . '/../..' . '/includes/GetInstance.php',
        'NotificationX\\NotificationX' => __DIR__ . '/../..' . '/includes/NotificationX.php',
        'NotificationX\\ThirdParty\\VisualPortfolio' => __DIR__ . '/../..' . '/includes/ThirdParty/VisualPortfolio.php',
        'NotificationX\\ThirdParty\\WPML' => __DIR__ . '/../..' . '/includes/ThirdParty/WPML.php',
        'NotificationX\\Types\\Comments' => __DIR__ . '/../..' . '/includes/Types/Comments.php',
        'NotificationX\\Types\\ContactForm' => __DIR__ . '/../..' . '/includes/Types/ContactForm.php',
        'NotificationX\\Types\\Conversions' => __DIR__ . '/../..' . '/includes/Types/Conversions.php',
        'NotificationX\\Types\\CustomNotification' => __DIR__ . '/../..' . '/includes/Types/CustomNotification.php',
        'NotificationX\\Types\\Donations' => __DIR__ . '/../..' . '/includes/Types/Donations.php',
        'NotificationX\\Types\\DownloadStats' => __DIR__ . '/../..' . '/includes/Types/DownloadStats.php',
        'NotificationX\\Types\\ELearning' => __DIR__ . '/../..' . '/includes/Types/ELearning.php',
        'NotificationX\\Types\\EmailSubscription' => __DIR__ . '/../..' . '/includes/Types/EmailSubscription.php',
        'NotificationX\\Types\\FlashingTab' => __DIR__ . '/../..' . '/includes/Types/FlashingTab.php',
        'NotificationX\\Types\\Inline' => __DIR__ . '/../..' . '/includes/Types/Inline.php',
        'NotificationX\\Types\\NotificationBar' => __DIR__ . '/../..' . '/includes/Types/NotificationBar.php',
        'NotificationX\\Types\\PageAnalytics' => __DIR__ . '/../..' . '/includes/Types/PageAnalytics.php',
        'NotificationX\\Types\\Reviews' => __DIR__ . '/../..' . '/includes/Types/Reviews.php',
        'NotificationX\\Types\\TypeFactory' => __DIR__ . '/../..' . '/includes/Types/TypesFactory.php',
        'NotificationX\\Types\\Types' => __DIR__ . '/../..' . '/includes/Types/Types.php',
        'NotificationX\\Types\\Video' => __DIR__ . '/../..' . '/includes/Types/Video.php',
        'NotificationX\\Types\\WooCommerceSales' => __DIR__ . '/../..' . '/includes/Types/WooCommerceSales.php',
        'UsabilityDynamics\\Job' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-job.php',
        'UsabilityDynamics\\Loader' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-loader.php',
        'UsabilityDynamics\\Settings' => __DIR__ . '/..' . '/udx/lib-settings/lib/class-settings.php',
        'UsabilityDynamics\\Structure' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-structure.php',
        'UsabilityDynamics\\Term' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-term.php',
        'UsabilityDynamics\\Utility' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-utility.php',
        'UsabilityDynamics\\Utility\\Guid_Fix' => __DIR__ . '/..' . '/udx/lib-utility/lib/class-guid-fix.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit89ec86686dc155609d949b902a87bbd5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89ec86686dc155609d949b902a87bbd5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit89ec86686dc155609d949b902a87bbd5::$classMap;

        }, null, ClassLoader::class);
    }
}
