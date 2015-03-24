<?php
class TaiChiRank extends AppModel {
    var $hasMany = array('User');
    var $belongsTo = array('RankType');
}
?>