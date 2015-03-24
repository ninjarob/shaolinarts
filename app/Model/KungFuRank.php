<?php
class KungFuRank extends AppModel {
    var $hasMany = array('User');
    var $belongsTo = array('RankType');
}
?>