<?php

namespace App\Traits;

trait VoiceToneTrait
{
    /**
     * Translate tone
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function translateTone($tone, $language)
    {
        switch ($language) {
            case 'ar-AE':
                switch ($tone) {
                    case 'funny': return 'مضحك'; break; 
                    case 'casual': return 'غير رسمي'; break; 
                    case 'excited': return 'متحمس'; break; 
                    case 'professional': return 'احترافي'; break; 
                    case 'witty': return 'بارع'; break; 
                    case 'sarcastic': return 'ساخر'; break; 
                    case 'feminine': return 'المؤنث'; break; 
                    case 'masculine': return 'مذكر'; break; 
                    case 'bold': return 'عريض'; break; 
                    case 'dramatic': return 'دراماتيكي'; break; 
                    case 'gumpy': return 'غامبي'; break; 
                    case 'secretive': return 'كتوم'; break; 
                }
                break;
            case 'cmn-CN':
                switch ($tone) {
                    case 'funny': return '有趣的'; break; 
                    case 'casual': return '随意的'; break; 
                    case 'excited': return '兴奋的'; break; 
                    case 'professional': return '专业的'; break; 
                    case 'witty': return '机智'; break; 
                    case 'sarcastic': return '讽刺的'; break; 
                    case 'feminine': return '女性化的'; break; 
                    case 'masculine': return '男性'; break; 
                    case 'bold': return '大胆的'; break; 
                    case 'dramatic': return '戏剧性'; break; 
                    case 'gumpy': return '脾气暴躁的'; break; 
                    case 'secretive': return '神秘的'; break; 
                }
                    break;
            case 'hr-HR':
                switch ($tone) {
                    case 'funny': return 'smiješno'; break; 
                    case 'casual': return 'ležeran'; break; 
                    case 'excited': return 'uzbuđen'; break; 
                    case 'professional': return 'profesionalni'; break; 
                    case 'witty': return 'duhovit'; break; 
                    case 'sarcastic': return 'sarkastičan'; break; 
                    case 'feminine': return 'ženski'; break; 
                    case 'masculine': return 'muški'; break; 
                    case 'bold': return 'podebljano'; break; 
                    case 'dramatic': return 'dramatičan'; break; 
                    case 'gumpy': return 'gumiran'; break; 
                    case 'secretive': return 'tajnovit'; break; 
                }
                break;
            case 'cs-CZ':
                switch ($tone) {
                    case 'funny': return 'legrační'; break; 
                    case 'casual': return 'neformální'; break; 
                    case 'excited': return 'vzrušený'; break; 
                    case 'professional': return 'profesionální'; break; 
                    case 'witty': return 'vtipný'; break; 
                    case 'sarcastic': return 'sarkastický'; break; 
                    case 'feminine': return 'ženský'; break; 
                    case 'masculine': return 'mužský'; break; 
                    case 'bold': return 'tučně'; break; 
                    case 'dramatic': return 'dramatický'; break; 
                    case 'gumpy': return 'gumový'; break; 
                    case 'secretive': return 'tajnůstkářský'; break; 
                }
                break;
            case 'da-DK':
                switch ($tone) {
                    case 'funny': return 'sjov'; break; 
                    case 'casual': return 'afslappet'; break; 
                    case 'excited': return 'begejstret'; break; 
                    case 'professional': return 'professionel'; break; 
                    case 'witty': return 'vittig'; break; 
                    case 'sarcastic': return 'sarkastisk'; break; 
                    case 'feminine': return 'feminin'; break; 
                    case 'masculine': return 'maskulin'; break; 
                    case 'bold': return 'fremhævet'; break; 
                    case 'dramatic': return 'dramatisk'; break; 
                    case 'gumpy': return 'klumpet'; break; 
                    case 'secretive': return 'hemmelighedsfuld'; break; 
                }
                break;
            case 'nl-BE':
                switch ($tone) {
                    case 'funny': return 'grappig'; break; 
                    case 'casual': return 'casual'; break; 
                    case 'excited': return 'opgewonden'; break; 
                    case 'professional': return 'professioneel'; break; 
                    case 'witty': return 'geestig'; break; 
                    case 'sarcastic': return 'sarcastisch'; break; 
                    case 'feminine': return 'vrouwelijk'; break; 
                    case 'masculine': return 'mannelijk'; break; 
                    case 'bold': return 'vetgedrukt'; break; 
                    case 'dramatic': return 'dramatisch'; break; 
                    case 'gumpy': return 'gom'; break; 
                    case 'secretive': return 'geheimzinnig'; break; 
                }
                break;
            case 'et-EE':
                switch ($tone) {
                    case 'funny': return 'naljakas'; break; 
                    case 'casual': return 'juhuslik'; break; 
                    case 'excited': return 'erutatud'; break; 
                    case 'professional': return 'professionaalne'; break; 
                    case 'witty': return 'vaimukas'; break; 
                    case 'sarcastic': return 'sarkastiline'; break; 
                    case 'feminine': return 'naiselik'; break; 
                    case 'masculine': return 'mehelik'; break; 
                    case 'bold': return 'julge'; break; 
                    case 'dramatic': return 'dramaatiline'; break; 
                    case 'gumpy': return 'närune'; break; 
                    case 'secretive': return 'salajane'; break; 
                }
                break;
            case 'fil-PH':
                switch ($tone) {
                    case 'funny': return 'nakakatawa'; break; 
                    case 'casual': return 'kaswal'; break; 
                    case 'excited': return 'nasasabik'; break; 
                    case 'professional': return 'propesyonal'; break; 
                    case 'witty': return 'matalino'; break; 
                    case 'sarcastic': return 'sarcastic'; break; 
                    case 'feminine': return 'pambabae'; break; 
                    case 'masculine': return 'panlalaki'; break; 
                    case 'bold': return 'matapang'; break; 
                    case 'dramatic': return 'madrama'; break; 
                    case 'gumpy': return 'mabukol'; break; 
                    case 'secretive': return 'palihim'; break; 
                }
                break;
            case 'fi-FI':
                switch ($tone) {
                    case 'funny': return 'hauska'; break; 
                    case 'casual': return 'rento'; break; 
                    case 'excited': return 'innoissaan'; break; 
                    case 'professional': return 'ammattilainen'; break; 
                    case 'witty': return 'nokkela'; break; 
                    case 'sarcastic': return 'sarkastinen'; break; 
                    case 'feminine': return 'naisellinen'; break; 
                    case 'masculine': return 'maskuliini-'; break; 
                    case 'bold': return 'lihavoitu'; break; 
                    case 'dramatic': return 'dramaattinen'; break; 
                    case 'gumpy': return 'kuminen'; break; 
                    case 'secretive': return 'salaperäinen'; break; 
                }
                break;
            case 'fr-FR':
                switch ($tone) {
                    case 'funny': return 'drôle'; break; 
                    case 'casual': return 'occasionnel'; break; 
                    case 'excited': return 'excité'; break; 
                    case 'professional': return 'professionnel'; break; 
                    case 'witty': return 'spirituel'; break; 
                    case 'sarcastic': return 'sarcastique'; break; 
                    case 'feminine': return 'féminin'; break; 
                    case 'masculine': return 'masculin'; break; 
                    case 'bold': return 'gras'; break; 
                    case 'dramatic': return 'spectaculaire'; break; 
                    case 'gumpy': return 'gommeux'; break; 
                    case 'secretive': return 'secret'; break; 
                }
                break;
            case 'el-GR':
                switch ($tone) {
                    case 'funny': return 'lustig'; break; 
                    case 'casual': return 'lässig'; break; 
                    case 'excited': return 'aufgeregt'; break; 
                    case 'professional': return 'Fachmann'; break; 
                    case 'witty': return 'witzig'; break; 
                    case 'sarcastic': return 'sarkastisch'; break; 
                    case 'feminine': return 'feminin'; break; 
                    case 'masculine': return 'männlich'; break; 
                    case 'bold': return 'deutlich'; break; 
                    case 'dramatic': return 'dramatisch'; break; 
                    case 'gumpy': return 'gummiartig'; break; 
                    case 'secretive': return 'geheimnisvoll'; break; 
                }
                break;
            case 'el-GR':
                switch ($tone) {
                    case 'funny': return 'αστείος'; break; 
                    case 'casual': return 'ανέμελος'; break; 
                    case 'excited': return 'ενθουσιασμένος'; break; 
                    case 'professional': return 'επαγγελματίας'; break; 
                    case 'witty': return 'πνευματώδης'; break; 
                    case 'sarcastic': return 'σαρκαστικός'; break; 
                    case 'feminine': return 'θηλυκός'; break; 
                    case 'masculine': return 'αρρενωπός'; break; 
                    case 'bold': return 'τολμηρός'; break; 
                    case 'dramatic': return 'δραματικός'; break; 
                    case 'gumpy': return 'τσακισμένος'; break; 
                    case 'secretive': return 'εκκριτικός'; break; 
                }
                break;
            case 'he-IL':
                switch ($tone) {
                    case 'funny': return 'מצחיק'; break; 
                    case 'casual': return 'אַגָבִי'; break; 
                    case 'excited': return 'נִרגָשׁ'; break; 
                    case 'professional': return 'מקצועי'; break; 
                    case 'witty': return 'שָׁנוּן'; break; 
                    case 'sarcastic': return 'עוקצני'; break; 
                    case 'feminine': return 'נָשִׁי'; break; 
                    case 'masculine': return 'גַברִי'; break; 
                    case 'bold': return 'נוֹעָז'; break; 
                    case 'dramatic': return 'דְרָמָטִי'; break; 
                    case 'gumpy': return 'גומי'; break; 
                    case 'secretive': return 'סודי'; break; 
                }
                break;
            case 'hi-IN':
                switch ($tone) {
                    case 'funny': return 'मज़ेदार'; break; 
                    case 'casual': return 'अनौपचारिक'; break; 
                    case 'excited': return 'उत्तेजित'; break; 
                    case 'professional': return 'पेशेवर'; break; 
                    case 'witty': return 'विनोदपूर्ण'; break; 
                    case 'sarcastic': return 'व्यंग्यपूर्ण'; break; 
                    case 'feminine': return 'संज्ञा'; break; 
                    case 'masculine': return 'मदार्ना'; break; 
                    case 'bold': return 'निडर'; break; 
                    case 'dramatic': return 'नाटकीय'; break; 
                    case 'gumpy': return 'गम्पी'; break; 
                    case 'secretive': return 'गुप्त'; break; 
                }
                break;
            case 'hu-HU':
                switch ($tone) {
                    case 'funny': return 'vicces'; break; 
                    case 'casual': return 'alkalmi'; break; 
                    case 'excited': return 'izgatott'; break; 
                    case 'professional': return 'szakmai'; break; 
                    case 'witty': return 'szellemes'; break; 
                    case 'sarcastic': return 'szarkasztikus'; break; 
                    case 'feminine': return 'nőies'; break; 
                    case 'masculine': return 'férfias'; break; 
                    case 'bold': return 'bátor'; break; 
                    case 'dramatic': return 'drámai'; break; 
                    case 'gumpy': return 'gumiszerű'; break; 
                    case 'secretive': return 'titkos'; break; 
                }
                break;
            case 'is-IS':
                switch ($tone) {
                    case 'funny': return 'fyndið'; break; 
                    case 'casual': return 'frjálslegur'; break; 
                    case 'excited': return 'spenntur'; break; 
                    case 'professional': return 'faglegur'; break; 
                    case 'witty': return 'fyndinn'; break; 
                    case 'sarcastic': return 'kaldhæðni'; break; 
                    case 'feminine': return 'kvenleg'; break; 
                    case 'masculine': return 'karlkyns'; break; 
                    case 'bold': return 'feitletrað'; break; 
                    case 'dramatic': return 'dramatískt'; break; 
                    case 'gumpy': return 'gúmmí'; break; 
                    case 'secretive': return 'leyndarmál'; break; 
                }
                break;
            case 'id-ID':
                switch ($tone) {
                    case 'funny': return 'lucu'; break; 
                    case 'casual': return 'kasual'; break; 
                    case 'excited': return 'bersemangat'; break; 
                    case 'professional': return 'profesional'; break; 
                    case 'witty': return 'cerdas'; break; 
                    case 'sarcastic': return 'sarkastik'; break; 
                    case 'feminine': return 'wanita'; break; 
                    case 'masculine': return 'maskulin'; break; 
                    case 'bold': return 'berani'; break; 
                    case 'dramatic': return 'dramatis'; break; 
                    case 'gumpy': return 'bergetah'; break; 
                    case 'secretive': return 'rahasia'; break; 
                }
                break;
            case 'it-IT':
                switch ($tone) {
                    case 'funny': return 'divertente'; break; 
                    case 'casual': return 'casuale'; break; 
                    case 'excited': return 'eccitato'; break; 
                    case 'professional': return 'professionale'; break; 
                    case 'witty': return 'spiritoso'; break; 
                    case 'sarcastic': return 'sarcastico'; break; 
                    case 'feminine': return 'femminile'; break; 
                    case 'masculine': return 'maschile'; break; 
                    case 'bold': return 'grassetto'; break; 
                    case 'dramatic': return 'drammatico'; break; 
                    case 'gumpy': return 'gommoso'; break; 
                    case 'secretive': return 'segreto'; break; 
                }
                break;
            case 'ja-JP':
                switch ($tone) {
                    case 'funny': return '面白い'; break; 
                    case 'casual': return 'カジュアル'; break; 
                    case 'excited': return '興奮した'; break; 
                    case 'professional': return 'プロ'; break; 
                    case 'witty': return '機知に富んだ'; break; 
                    case 'sarcastic': return '皮肉な'; break; 
                    case 'feminine': return 'フェミニン'; break; 
                    case 'masculine': return '男性的な'; break; 
                    case 'bold': return '大胆な'; break; 
                    case 'dramatic': return '劇的'; break; 
                    case 'gumpy': return 'ガンピー'; break; 
                    case 'secretive': return '秘密主義'; break; 
                }
                break;            
            case 'jv-ID':
                switch ($tone) {
                    case 'funny': return 'lucu'; break; 
                    case 'casual': return 'sembrono'; break; 
                    case 'excited': return 'bungah'; break; 
                    case 'professional': return 'profesional'; break; 
                    case 'witty': return 'pinter'; break; 
                    case 'sarcastic': return 'sarkastik'; break; 
                    case 'feminine': return 'wadon'; break; 
                    case 'masculine': return 'lanang'; break; 
                    case 'bold': return 'kandel'; break; 
                    case 'dramatic': return 'dramatis'; break; 
                    case 'gumpy': return 'gumuk'; break; 
                    case 'secretive': return 'rahasia'; break; 
                }
                break;
            case 'ko-KR':
                switch ($tone) {
                    case 'funny': return '재미있는'; break; 
                    case 'casual': return '평상복'; break; 
                    case 'excited': return '흥분한'; break; 
                    case 'professional': return '전문적인'; break; 
                    case 'witty': return '재치 있는'; break; 
                    case 'sarcastic': return '비꼬는'; break; 
                    case 'feminine': return '여자 같은'; break; 
                    case 'masculine': return '남성 명사'; break; 
                    case 'bold': return '용감한'; break; 
                    case 'dramatic': return '극적인'; break; 
                    case 'gumpy': return '구질구질한'; break; 
                    case 'secretive': return '비밀스러운'; break; 
                }
                break;
            case 'ms-MY':
                switch ($tone) {
                    case 'funny': return 'kelakar'; break; 
                    case 'casual': return 'santai'; break; 
                    case 'excited': return 'teruja'; break; 
                    case 'professional': return 'profesional'; break; 
                    case 'witty': return 'jenaka'; break; 
                    case 'sarcastic': return 'sarkastik'; break; 
                    case 'feminine': return 'keperempuanan'; break; 
                    case 'masculine': return 'maskulin'; break; 
                    case 'bold': return 'berani'; break; 
                    case 'dramatic': return 'dramatik'; break; 
                    case 'gumpy': return 'bergetah'; break; 
                    case 'secretive': return 'berahsia'; break; 
                }
                break;
            case 'nb-NO':
                switch ($tone) {
                    case 'funny': return 'morsom'; break; 
                    case 'casual': return 'uformelt'; break; 
                    case 'excited': return 'spent'; break; 
                    case 'professional': return 'profesjonell'; break; 
                    case 'witty': return 'vittig'; break; 
                    case 'sarcastic': return 'sarkastisk'; break; 
                    case 'feminine': return 'feminin'; break; 
                    case 'masculine': return 'maskulin'; break; 
                    case 'bold': return 'dristig'; break; 
                    case 'dramatic': return 'dramatisk'; break; 
                    case 'gumpy': return 'klumpete'; break; 
                    case 'secretive': return 'hemmelighetsfull'; break; 
                }
                break;
            case 'pl-PL':
                switch ($tone) {
                    case 'funny': return 'śmieszny'; break; 
                    case 'casual': return 'zwykły'; break; 
                    case 'excited': return 'podekscytowany'; break; 
                    case 'professional': return 'profesjonalny'; break; 
                    case 'witty': return 'dowcipny'; break; 
                    case 'sarcastic': return 'sarkastyczny'; break; 
                    case 'feminine': return 'kobiecy'; break; 
                    case 'masculine': return 'rodzaj męski'; break; 
                    case 'bold': return 'pogrubiony'; break; 
                    case 'dramatic': return 'dramatyczny'; break; 
                    case 'gumpy': return 'gumowaty'; break; 
                    case 'secretive': return 'skryty'; break; 
                }
                break;
            case 'pt-PT':
            case 'pt-BR':
                switch ($tone) {
                    case 'funny': return 'engraçado'; break; 
                    case 'casual': return 'casual'; break; 
                    case 'excited': return 'excitado'; break; 
                    case 'professional': return 'profissional'; break; 
                    case 'witty': return 'inteligente'; break; 
                    case 'sarcastic': return 'sarcástico'; break; 
                    case 'feminine': return 'feminino'; break; 
                    case 'masculine': return 'masculino'; break; 
                    case 'bold': return 'audacioso'; break; 
                    case 'dramatic': return 'dramático'; break; 
                    case 'gumpy': return 'pegajoso'; break; 
                    case 'secretive': return 'secreto'; break; 
                }
                break;
            case 'ru-RU':
                switch ($tone) {
                    case 'funny': return 'смешной'; break; 
                    case 'casual': return 'повседневный'; break; 
                    case 'excited': return 'взволнованный'; break; 
                    case 'professional': return 'профессиональный'; break; 
                    case 'witty': return 'остроумный'; break; 
                    case 'sarcastic': return 'саркастический'; break; 
                    case 'feminine': return 'женский'; break; 
                    case 'masculine': return 'мужской'; break; 
                    case 'bold': return 'смелый'; break; 
                    case 'dramatic': return 'драматический'; break; 
                    case 'gumpy': return 'липкий'; break; 
                    case 'secretive': return 'скрытный'; break; 
                }
                break;
            case 'es-ES':
                switch ($tone) {
                    case 'funny': return 'divertido'; break; 
                    case 'casual': return 'casual'; break; 
                    case 'excited': return 'уmocionado'; break; 
                    case 'professional': return 'profesional'; break; 
                    case 'witty': return 'ingenioso'; break; 
                    case 'sarcastic': return 'sarcástico'; break; 
                    case 'feminine': return 'femenino'; break; 
                    case 'masculine': return 'masculino'; break; 
                    case 'bold': return 'atrevido'; break; 
                    case 'dramatic': return 'dramático'; break; 
                    case 'gumpy': return 'gomoso'; break; 
                    case 'secretive': return 'secreto'; break; 
                }
                break;
            case 'sv-SE':
                switch ($tone) {
                    case 'funny': return 'rolig'; break; 
                    case 'casual': return 'tillfällig'; break; 
                    case 'excited': return 'upphetsad'; break; 
                    case 'professional': return 'professionell'; break; 
                    case 'witty': return 'kvick'; break; 
                    case 'sarcastic': return 'sarkastisk'; break; 
                    case 'feminine': return 'feminin'; break; 
                    case 'masculine': return 'maskulin'; break; 
                    case 'bold': return 'djärv'; break; 
                    case 'dramatic': return 'dramatisk'; break; 
                    case 'gumpy': return 'gumpig'; break; 
                    case 'secretive': return 'hemlighetsfull'; break; 
                }
                break;
            case 'th-TH':
                switch ($tone) {
                    case 'funny': return 'ตลก'; break; 
                    case 'casual': return 'ไม่เป็นทางการ'; break; 
                    case 'excited': return 'ตื่นเต้น'; break; 
                    case 'professional': return 'มืออาชีพ'; break; 
                    case 'witty': return 'มีไหวพริบ'; break; 
                    case 'sarcastic': return 'ประชดประชัน'; break; 
                    case 'feminine': return 'ของผู้หญิง'; break; 
                    case 'masculine': return 'ผู้ชาย'; break; 
                    case 'bold': return 'ตัวหนา'; break; 
                    case 'dramatic': return 'น่าทึ่ง'; break; 
                    case 'gumpy': return 'เหนียว'; break; 
                    case 'secretive': return 'ลับ'; break; 
                }
                break;
            case 'tr-TR':
                switch ($tone) {
                    case 'funny': return 'eğlenceli'; break; 
                    case 'casual': return 'gündelik'; break; 
                    case 'excited': return 'heyecanlı'; break; 
                    case 'professional': return 'profesyonel'; break; 
                    case 'witty': return 'esprili'; break; 
                    case 'sarcastic': return 'alaycı'; break; 
                    case 'feminine': return 'kadınsı'; break; 
                    case 'masculine': return 'eril'; break; 
                    case 'bold': return 'gözü pek'; break; 
                    case 'dramatic': return 'dramatik'; break; 
                    case 'gumpy': return 'sakızlı'; break; 
                    case 'secretive': return 'gizli'; break; 
                }
                break;
            case 'sw-KE':
                switch ($tone) {
                    case 'funny': return 'kuchekesha'; break; 
                    case 'casual': return 'kawaida'; break; 
                    case 'excited': return 'msisimko'; break; 
                    case 'professional': return 'mtaalamu'; break; 
                    case 'witty': return 'mwenye akili'; break; 
                    case 'sarcastic': return 'dhihaka'; break; 
                    case 'feminine': return 'kike'; break; 
                    case 'masculine': return 'kiume'; break; 
                    case 'bold': return 'ujasiri'; break; 
                    case 'dramatic': return 'makubwa'; break; 
                    case 'gumpy': return 'gumpy'; break; 
                    case 'secretive': return 'siri'; break; 
                }
                break;
            case 'ro-RO':
                switch ($tone) {
                    case 'funny': return 'amuzant'; break; 
                    case 'casual': return 'casual'; break; 
                    case 'excited': return 'emoționat'; break; 
                    case 'professional': return 'profesionist'; break; 
                    case 'witty': return 'inteligente'; break; 
                    case 'sarcastic': return 'sarcástico'; break; 
                    case 'feminine': return 'feminin'; break; 
                    case 'masculine': return 'masculin'; break; 
                    case 'bold': return 'îndrăzneț'; break; 
                    case 'dramatic': return 'dramático'; break; 
                    case 'gumpy': return 'pegajoso'; break; 
                    case 'secretive': return 'secret'; break; 
                }
                break;
            case 'vi-VN':
                switch ($tone) {
                    case 'funny': return 'hài hước'; break; 
                    case 'casual': return 'bình thường'; break; 
                    case 'excited': return 'phấn khích'; break; 
                    case 'professional': return 'chuyên nghiệp'; break; 
                    case 'witty': return 'dí dỏm'; break; 
                    case 'sarcastic': return 'châm biếm'; break; 
                    case 'feminine': return 'nữ tính'; break; 
                    case 'masculine': return 'nam tính'; break; 
                    case 'bold': return 'in đậm'; break; 
                    case 'dramatic': return 'kịch tính'; break; 
                    case 'gumpy': return 'pegajoso'; break; 
                    case 'secretive': return 'bí mật'; break; 
                }
                break;
            case 'sl-SI':
                switch ($tone) {
                    case 'funny': return 'smešno'; break; 
                    case 'casual': return 'priložnostno'; break; 
                    case 'excited': return 'navdušen'; break; 
                    case 'professional': return 'profesionalni'; break; 
                    case 'witty': return 'duhovit'; break; 
                    case 'sarcastic': return 'sarkastični'; break; 
                    case 'feminine': return 'ženskega'; break; 
                    case 'masculine': return 'moško'; break; 
                    case 'bold': return 'krepko'; break; 
                    case 'dramatic': return 'dramatičen'; break; 
                    case 'gumpy': return 'pegajoso'; break; 
                    case 'tajnost': return 'bí mật'; break; 
                }
                break;
            default:
                # code...
                break;
        }
    }
}