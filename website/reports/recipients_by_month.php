<?
include_once 'db_queries.php';
$res = getRecipients();
$cnt = getCountries();
// "All payments are done from <strong>1GRgEnKujorJJ9VBa76g8cp3sfoWtQqSs4</strong> Bitcoin address. ";
//  "The payouts are distributed based on the ranking which is available on the OSM Contributions tab, the last ranking has weight = 1, the ranking before the last has weight = 2 and so on till the 1st ranking.<br>";
// var rg = recipientRegionName == '' ? 'Worldwide' : recipientRegionName; 
$visibleReg = $res->region;
if($res->region == '') {
    $visibleReg = "Worldwide";
} else {
    for($i = 0; $i < count($cnt->rows); $i++) {
        if($cnt->rows[$i]->downloadname == $res->region) {
            $visibleReg = $cnt->rows[$i]->name;
            break;
        }
    }
}
$month = $res->month
if(is_null(getReport('getBTCValue'))) {
    $res->message = "<p class='recipients-data-header overview-hint'>Currently collected in <span id='#overview-recipients_option'>".$month."</span> </p>";
    $res->message = $res->message . "<div class='overview overview-btc'><p>" . 
                    number_format($res->btc * 1000, 3) . " mBTC</p><span>total collected (may change in the final report)</span></div>" .
                    "<div class='overview overview-btc'><p>" . 
                    number_format($res->regionBtc*1000, 3) . " mBTC</p><span>collected for {$visibleReg}</span></div>";

} else {
    $res->message = "<p class='recipients-data-header overview-hint'>Totally collected in <span id='#overview-recipients_option'>".$month."</span></p>";
    $res->message = $res->message . "<div class='overview overview-btc'><p>" . 
                    number_format($res->btc * 1000, 3) . " mBTC</p><span>total collected</span></div>" .
                    "<div class='overview overview-btc'><p>"  .
                    number_format($res->regionBtc*1000, 3) . " mBTC</p><span>collected for {$visibleReg}</span></div>";
    $payouts = '';                
    if($res->month == '2016-01') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/d5d780bb8171e6438531d4b439d55f6e299c5f70d352ade6db98c7d040baf02c">Transaction #1</a>';
    } else if($res->month == '2016-02') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/8158da594891265e36ec2ba531061e7edcde27e2a46b459c9019bfa280b2cf85">Transaction #1</a>';
    } else if($res->month == '2016-03') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/3972ae6a30ed4a97f3b448f5bef360e6ca9858dec4e2c1fce4d5971b0897823e">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/3f1fc2d9bd0abc184d77d5457c915ed5252bce21dfda0299347fee863423ee73">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/b86aa1773e2c256da33632c725b1d5c5227aad406bff5fbf27924c30298ec426">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/513f7ada01e01cbb56f87ea8d70c8da4e3b8c9e49e19c44813f7a56669b499d3">Transaction #4</a>';
    } else if($res->month == '2016-04') {
        $payouts = $payouts . 'a href="https://blockchain.info/tx/811fe35729272a754178c6d385a31f5604f1f3c97126ed90f7ead0f93c60ca2f">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1b3a2ad4498882b70f117bb7a2f4ed01fcf0b55d8b734a4710c1530c3b7e9ac">Transaction #2</a>';
    } else if($res->month == '2016-05') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/c68717df1663a87bb91a540c05989db645cb94e89b508457322bd1393c4ccda0">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1df5e24f3edb0ce6932be78f23293cca7d1c54a5ef1d8506ac2f4205cb4bfdfd">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/6f1365a832456c60259ca77dabb1b02b7db51cd22aa58e8036f46962a997c6d2">Transaction #3</a>';
    } else if($res->month == '2016-06') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/423f91fb54b909f0a79372cc921b35a78b894d0a7e0113cf8fd540569837f63d">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1468dc62e9442676847be035a6b2dc939cc3a9f995e3aae0c4ea03b8f8b76196">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7c0e8db39121b0282082398a62cafadcee6e5b705a1eb1b1989c9eb709fe224a">Transaction #3</a>';
    } else if($res->month == '2016-07') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/0638dcac87566cbb5f17c02f13d9c31cb78bc75435f4a654a924bf5b833884f8">Transaction #1</a>';
        $payouts = $payouts . '<a href="https://blockchain.info/tx/c0eef69d6d67a77617a3c716b0e13db49aff85868fe6b6fa2dec2122ec8bd22f">Transaction #2</a>';
        $payouts = $payouts . '<a href="https://blockchain.info/tx/1614be05444686ba2729751a839dae1e75b1c08ac737d9e0b2262ff0b4f2f616">Transaction #3</a>';
    }
    if(!($payouts == '')) {
        $res->message = $res->message . "<p class='recipients-data-header overview-hint'>Payouts".$payouts."</p>&nbsp;";
    }
    $res->message = $res->message. '<p><a href="http://builder.osmand.net/reports/query_month_report.php?report=total&month='.$res->month.'">Download all json reports for '.$month.' </a></p>';
}
        
echo json_encode($res);
?>
