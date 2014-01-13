<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped condensed',
    'enablePagination' => true,
    'dataProvider' => Customers::model()->getBooker(1),
    'template' => "{pager}{items}\n",
    'columns' => array(
        array(
            'name' => 'C_name',
            'header' => 'ชื่อ',
        ),
        array(
            'name' => 'C_seats',
            'header' => 'จำนวน',
        ),
        array(
            'name' => 'C_time',
            'header' => 'เวลา',
        ),
        array(
            'name' => 'PIN',
            'header' => 'PIN',
        ),
    ),
));

