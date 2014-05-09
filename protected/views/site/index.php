<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="row" style="background: #eeeeff; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; color: inherit; padding-top: 10px;padding-bottom: 10px"">
    <div class="span8">
        <div class="hero-unit">
            <h2 align="center">เชิญลูกค้าเข้ารับบริการ</h2>
        </div>
        <div >
            <!-- Codes by HTML.am -->
            <table align="center" width="80%" border="0">
                <tr>
                    <th width="50%"><h3>ชื่อผู้จอง</h3></th>
                <th><h3>PIN</h3></th>
                </tr>
            </table>
            <marquee behavior="scroll" direction="up" scrollamount="3">
                <table align="center" width="80%" border="1">
                    <?php
                    $calls = $this->getCalls();
                    foreach ($calls as $value) {
                        ?>
                        <tr>
                            <td width="50%" align="center">      
                                <h4>
                                    <?php
                                    echo $value['C_name'];
                                    ?>
                                </h4>
                            </td>
                            <td align="center">
                                <h4>
                                    <?php
                                    echo$value['PIN'];
                                    ?>
                                </h4>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </marquee>
        </div>
    </div>

    <div class="span4">
        <div align="middle" style="background: #eeeeff; -webkit-border-radius: 6px;
             -moz-border-radius: 6px; border-radius: 6px; color: inherit;
             padding: 30px; margin-bottom: 30px;">
            <h3>จำนวนที่ว่างปัจจุบัน</h3>
            <?php
            $this->getAll();
            ?>
        </div>
    </div>
</div>
