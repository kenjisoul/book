<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
                    'stacked' => false, // whether this is a stacked menu
                    'items' => array(
                        array('label' => 'หน้าหลัก', 'url' => array('/site/index')),
                        array('label' => 'จองคิว', 'url' => array('/customers/index')),
                        array('label' => 'ตรวจสอบ', 'url' => array('/customers/check')),
                        array('label' => 'ยกเลิกการจอง', 'url' => array('/customers/cancel')),
                        array('label' => 'จัดการคิว', 'url' => array('/customers/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'จัดการผู้ใช้', 'url' => array('/account/index'), 'visible' => Yii::app()->user->name == 'admin'),
                        array('label' => 'โซนร้าน', 'url' => array('/rZone/index'), 'visible' => Yii::app()->user->name == 'admin'),
                        array('label' => 'รายละเอียดร้าน', 'url' => array('/restaurant/index'), 'visible' => Yii::app()->user->name == 'admin'),
                        array('label' => 'จำนวนที่นั่ง ', 'url' => array('/rDetails/index'), 'visible' => Yii::app()->user->name == 'admin'),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        ));
        ?>

        <div class="container" id="page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
