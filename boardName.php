<?php

class Name {
    protected $name;
    protected $tbName;
    
    public function __construct($name,$tbName) {
        $this->name = $name;
        $this->tbName = $tbName;
    }

    public function getName() {
        return $this->name;
    }

    public function getTbName() {
        return $this->tbName;
    }
}

$boardName[0] = new Name('地震','earthquake');
$boardName[1] = new Name('COVID-19','NewCoronavirus');
$boardName[2] = new Name('星のカービイ','KirbysDreamLand');
$boardName[3] = new Name('be','be');
$boardName[4] = new Name('ニュース','news');
$boardName[5] = new Name('世界情勢','WorldAffairs');
$boardName[6] = new Name('案内','guide');
$boardName[7] = new Name('運営','operation');
$boardName[8] = new Name('馴れ合い','familiarity');
$boardName[9] = new Name('AA','aa');
$boardName[10] = new Name('社会','society');
$boardName[11] = new Name('会社・職業','profession');
$boardName[12] = new Name('裏社会','UndergroundCommunity');
$boardName[13] = new Name('地域','area');
$boardName[14] = new Name('文化','culture');
$boardName[15] = new Name('学問・理系','science');
$boardName[16] = new Name('学問・文系','humanities');
$boardName[17] = new Name('家電製品','homeAppliances');
$boardName[18] = new Name('政治経済','politicalEconomy');
$boardName[19] = new Name('食文化','foodCulture');
$boardName[20] = new Name('生活','life');
$boardName[21] = new Name('ネタ雑談','netachat');
$boardName[22] = new Name('カテゴリ雑談','categoryChat');
$boardName[23] = new Name('実況ch','theRealCondition');
$boardName[24] = new Name('受験・学校','school');
$boardName[25] = new Name('趣味','hobby');
$boardName[26] = new Name('乗り物','vehicle');
$boardName[27] = new Name('スポーツ一般','sports');
$boardName[28] = new Name('球技','ballGames');
$boardName[29] = new Name('格闘技','martialArts');
$boardName[30] = new Name('旅行・外出','travel');
$boardName[31] = new Name('テレビ等','tv');
$boardName[32] = new Name('芸能','performingArts');
$boardName[33] = new Name('アイドル','idol');
$boardName[34] = new Name('ギャンブル','gambling');
$boardName[35] = new Name('ゲーム','game');
$boardName[36] = new Name('携帯型ゲーム','handheldGame');
$boardName[37] = new Name('ネットゲーム','InternetGame');
$boardName[38] = new Name('漫画・小説等','comics');
$boardName[39] = new Name('音楽','music');
$boardName[40] = new Name('心と体','body');
$boardName[41] = new Name('PC等','pc');
$boardName[42] = new Name('ネット関係','InternetRelations');
$boardName[43] = new Name('雑談系2','chat2');
$boardName[44] = new Name('大使館','embassy');
$boardName[45] = new Name('荒野','wilderness');
     
?>
