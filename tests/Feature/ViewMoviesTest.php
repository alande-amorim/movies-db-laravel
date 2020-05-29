<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPLayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPageShowsCorrectInfo()
    {
        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
        $response->assertSee('Popular Movies');
        $response->assertSee('Test Fake Movie');
        $response->assertSee('Drama');
        $response->assertSee('Science Fiction');

        $html = $response->getContent();
        $this->assertEquals(1, preg_match('/Drama, *Science Fiction/', $html), 'Page doenst contain expected genres');

        $response->assertSee('Now Playing');
        $response->assertSee('Test Fake Movie 2');
    }

    /**
     *
     */
    private function fakePopularMovies()
    {
        return Http::response(
            json_decode('{"page":1,"total_results":10000,"total_pages":500,"results":[{"popularity":517.169,"vote_count":3520,"video":false,"poster_path":"\/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg","id":419704,"adult":false,"backdrop_path":"\/5BwqwxMEjeFtdknRV792Svo0K1v.jpg","original_language":"en","original_title":"Ad Astra","genre_ids":[18,878],"title":"Test Fake Movie","vote_average":6,"overview":"The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.","release_date":"2019-09-17"},{"popularity":183.316,"vote_count":2413,"video":false,"poster_path":"\/8WUVHemHFH2ZIP6NWkwlHWsyrEL.jpg","id":338762,"adult":false,"backdrop_path":"\/ocUrMYbdjknu2TwzMHKT9PBBQRw.jpg","original_language":"en","original_title":"Bloodshot","genre_ids":[28,878],"title":"Bloodshot","vote_average":7.1,"overview":"After he and his wife are murdered, marine Ray Garrison is resurrected by a team of scientists. Enhanced with nanotechnology, he becomes a superhuman, biotech killing machine—\'Bloodshot\'. As Ray first trains with fellow super-soldiers, he cannot recall anything from his former life. But when his memories flood back and he remembers the man that killed both him and his wife, he breaks out of the facility to get revenge, only to discover that there\'s more to the conspiracy than he thought.","release_date":"2020-03-05"},{"popularity":144.906,"vote_count":755,"video":false,"poster_path":"\/jHo2M1OiH9Re33jYtUQdfzPeUkx.jpg","id":385103,"adult":false,"backdrop_path":"\/b5Fej0UT6gPFd2GcGEWw4SAwGUM.jpg","original_language":"en","original_title":"Scoob!","genre_ids":[12,16,35,9648,10751],"title":"Scoob!","vote_average":8.1,"overview":"In Scooby-Doo’s greatest adventure yet, see the never-before told story of how lifelong friends Scooby and Shaggy first met and how they joined forces with young detectives Fred, Velma, and Daphne to form the famous Mystery Inc. Now, with hundreds of cases solved, Scooby and the gang face their biggest, toughest mystery ever: an evil plot to unleash the ghost dog Cerberus upon the world. As they race to stop this global “dogpocalypse,” the gang discovers that Scooby has a secret legacy and an epic destiny greater than anyone ever imagined.","release_date":"2020-05-15"},{"popularity":118.5,"vote_count":129,"video":false,"poster_path":"\/5jdLnvALCpK1NkeQU1z4YvOe2dZ.jpg","id":576156,"adult":false,"backdrop_path":"\/1EGFjibWzsN2GNNeOSQBYhQ9pK5.jpg","original_language":"en","original_title":"The Lovebirds","genre_ids":[28,35,10749],"title":"The Lovebirds","vote_average":6.4,"overview":"A couple experiences a defining moment in their relationship when they are unintentionally embroiled in a murder mystery. As their journey to clear their names takes them from one extreme – and hilarious - circumstance to the next, they must figure out how they, and their relationship, can survive the night.","release_date":"2020-05-22"},{"popularity":109.45,"vote_count":4214,"video":false,"poster_path":"\/aQvJ5WPzZgYVDrxLX4R6cLJCEaQ.jpg","id":454626,"adult":false,"backdrop_path":"\/stmYfCUGd8Iy6kAMBr6AmWqx8Bq.jpg","original_language":"en","original_title":"Sonic the Hedgehog","genre_ids":[28,35,878,10751],"title":"Sonic the Hedgehog","vote_average":7.5,"overview":"Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend the planet from the evil genius Dr. Robotnik and his plans for world domination.","release_date":"2020-02-12"},{"popularity":102.192,"vote_count":4132,"video":false,"poster_path":"\/h4VB6m0RwcicVEZvzftYZyKXs6K.jpg","id":495764,"adult":false,"backdrop_path":"\/kvbbK2rLGSJh9rf6gg1i1iVLYQS.jpg","original_language":"en","original_title":"Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)","genre_ids":[28,35,80],"title":"Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)","vote_average":7.2,"overview":"Harley Quinn joins forces with a singer, an assassin and a police detective to help a young girl who had a hit placed on her after she stole a rare diamond from a crime lord.","release_date":"2020-02-05"},{"popularity":97.224,"vote_count":4088,"video":false,"poster_path":"\/y95lQLnuNKdPAzw9F9Ab8kJ80c3.jpg","id":38700,"adult":false,"backdrop_path":"\/upUy2QhMZEmtypPW3PdieKLAHxh.jpg","original_language":"en","original_title":"Bad Boys for Life","genre_ids":[28,80,53],"title":"Bad Boys for Life","vote_average":7.2,"overview":"Marcus and Mike are forced to confront new threats, career changes, and midlife crises as they join the newly created elite team AMMO of the Miami police department to take down the ruthless Armando Armas, the vicious leader of a Miami drug cartel.","release_date":"2020-01-15"},{"popularity":97.197,"vote_count":66,"video":false,"poster_path":"\/niyXFhGIk4W2WTcX2Eod8vx2Mfe.jpg","id":686245,"adult":false,"backdrop_path":"\/pPguXG07MDRKH1agJdw1mWzuEkP.jpg","original_language":"en","original_title":"Survive the Night","genre_ids":[28,53],"title":"Survive the Night","vote_average":5.6,"overview":"A disgraced doctor and his family are held hostage at their home by criminals on the run, when a robbery-gone-awry requires them to seek immediate medical attention.","release_date":"2020-05-22"},{"popularity":88.822,"vote_count":7576,"video":false,"poster_path":"\/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg","id":496243,"adult":false,"backdrop_path":"\/ApiBzeaa95TNYliSbQ8pJv4Fje7.jpg","original_language":"ko","original_title":"기생충","genre_ids":[35,18,53],"title":"Parasite","vote_average":8.5,"overview":"All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.","release_date":"2019-05-30"},{"popularity":87.397,"vote_count":5101,"video":false,"poster_path":"\/iZf0KyrE25z1sage4SYFLCCrMi9.jpg","id":530915,"adult":false,"backdrop_path":"\/2lBOQK06tltt8SQaswgb8d657Mv.jpg","original_language":"en","original_title":"1917","genre_ids":[28,18,36,53,10752],"title":"1917","vote_average":7.9,"overview":"At the height of the First World War, two young British soldiers must cross enemy territory and deliver a message that will stop a deadly attack on hundreds of soldiers.","release_date":"2019-12-25"},{"popularity":84.997,"vote_count":12742,"video":false,"poster_path":"\/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg","id":475557,"adult":false,"backdrop_path":"\/f5F4cRhQdUbyVbB5lTNCwUzD6BP.jpg","original_language":"en","original_title":"Joker","genre_ids":[80,18,53],"title":"Joker","vote_average":8.2,"overview":"During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.","release_date":"2019-10-02"},{"popularity":84.697,"vote_count":4721,"video":false,"poster_path":"\/db32LaOibwEliAmSL2jjDF6oDdj.jpg","id":181812,"adult":false,"backdrop_path":"\/jOzrELAzFxtMx2I4uDGHOotdfsS.jpg","original_language":"en","original_title":"Star Wars: The Rise of Skywalker","genre_ids":[28,12,878],"title":"Star Wars: The Rise of Skywalker","vote_average":6.5,"overview":"The surviving Resistance faces the First Order once again as the journey of Rey, Finn and Poe Dameron continues. With the power and knowledge of generations behind them, the final battle begins.","release_date":"2019-12-18"},{"popularity":75.64,"vote_count":2174,"video":false,"poster_path":"\/wlfDxbGEsW58vGhFljKkcR5IxDj.jpg","id":545609,"adult":false,"backdrop_path":"\/1R6cvRtZgsYCkh8UFuWFN33xBP4.jpg","original_language":"en","original_title":"Extraction","genre_ids":[28,18,53],"title":"Extraction","vote_average":7.5,"overview":"Tyler Rake, a fearless mercenary who offers his services on the black market, embarks on a dangerous mission when he is hired to rescue the kidnapped son of a Mumbai crime lord…","release_date":"2020-04-24"},{"popularity":74.205,"vote_count":9390,"video":false,"poster_path":"\/qa6HCwP4Z15l3hpsASz3auugEW6.jpg","id":920,"adult":false,"backdrop_path":"\/sd4xN5xi8tKRPrJOWwNiZEile7f.jpg","original_language":"en","original_title":"Cars","genre_ids":[12,16,35,10751],"title":"Cars","vote_average":6.8,"overview":"Lightning McQueen, a hotshot rookie race car driven to succeed, discovers that life is about the journey, not the finish line, when he finds himself unexpectedly detoured in the sleepy Route 66 town of Radiator Springs. On route across the country to the big Piston Cup Championship in California to compete against two seasoned pros, McQueen gets to know the town\'s offbeat characters.","release_date":"2006-06-08"},{"popularity":74.152,"vote_count":1953,"video":false,"poster_path":"\/f4aul3FyD3jv3v4bul1IrkWZvzq.jpg","id":508439,"adult":false,"backdrop_path":"\/xFxk4vnirOtUxpOEWgA1MCRfy6J.jpg","original_language":"en","original_title":"Onward","genre_ids":[12,16,35,14,10751],"title":"Onward","vote_average":7.9,"overview":"In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.","release_date":"2020-02-29"},{"popularity":73.833,"vote_count":4656,"video":false,"poster_path":"\/pjeMs3yqRmFL3giJy4PMXWZTTPa.jpg","id":330457,"adult":false,"backdrop_path":"\/xJWPZIYOEFIjZpBL7SVBGnzRYXp.jpg","original_language":"en","original_title":"Frozen II","genre_ids":[12,16,10751],"title":"Frozen II","vote_average":7.2,"overview":"Elsa, Anna, Kristoff and Olaf head far into the forest to learn the truth about an ancient mystery of their kingdom.","release_date":"2019-11-20"},{"popularity":70.52,"vote_count":18274,"video":false,"poster_path":"\/7WsyChQLEftFiDOVTGkv3hFpyyt.jpg","id":299536,"adult":false,"backdrop_path":"\/lmZFxXgJE3vgrciwuDib0N8CfQo.jpg","original_language":"en","original_title":"Avengers: Infinity War","genre_ids":[28,12,878],"title":"Avengers: Infinity War","vote_average":8.3,"overview":"As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos. A despot of intergalactic infamy, his goal is to collect all six Infinity Stones, artifacts of unimaginable power, and use them to inflict his twisted will on all of reality. Everything the Avengers have fought for has led up to this moment - the fate of Earth and existence itself has never been more uncertain.","release_date":"2018-04-25"},{"popularity":70.508,"vote_count":16980,"video":false,"poster_path":"\/wuMc08IPKEatf9rnMNXvIDxqP4W.jpg","id":671,"adult":false,"backdrop_path":"\/hziiv14OpD73u9gAak4XDDfBKa2.jpg","original_language":"en","original_title":"Harry Potter and the Philosopher\'s Stone","genre_ids":[12,14,10751],"title":"Harry Potter and the Philosopher\'s Stone","vote_average":7.9,"overview":"Harry Potter has lived under the stairs at his aunt and uncle\'s house his whole life. But on his 11th birthday, he learns he\'s a powerful wizard -- with a place waiting for him at the Hogwarts School of Witchcraft and Wizardry. As he learns to harness his newfound powers with the help of the school\'s kindly headmaster, Harry uncovers the truth about his parents\' deaths -- and about the villain who\'s to blame.","release_date":"2001-11-16"},{"popularity":69.45,"vote_count":5935,"video":false,"poster_path":"\/3iYQTLGoy7QnjcUYRJy4YrAgGvp.jpg","id":420817,"adult":false,"backdrop_path":"\/v4yVTbbl8dE1UP2dWu5CLyaXOku.jpg","original_language":"en","original_title":"Aladdin","genre_ids":[12,35,14,10749,10751],"title":"Aladdin","vote_average":7.1,"overview":"A kindhearted street urchin named Aladdin embarks on a magical adventure after finding a lamp that releases a wisecracking genie while a power-hungry Grand Vizier vies for the same lamp that has the power to make their deepest wishes come true.","release_date":"2019-05-22"},{"popularity":69.359,"vote_count":485,"video":false,"poster_path":"\/c01Y4suApJ1Wic2xLmaq1QYcfoZ.jpg","id":618344,"adult":false,"backdrop_path":"\/sQkRiQo3nLrQYMXZodDjNUJKHZV.jpg","original_language":"en","original_title":"Justice League Dark: Apokolips War","genre_ids":[28,12,16,14,878],"title":"Justice League Dark: Apokolips War","vote_average":8.5,"overview":"Earth is decimated after intergalactic tyrant Darkseid has devastated the Justice League in a poorly executed war by the DC Super Heroes. Now the remaining bastions of good – the Justice League, Teen Titans, Suicide Squad and assorted others – must regroup, strategize and take the war to Darkseid in order to save the planet and its surviving inhabitants.","release_date":"2020-05-05"}]}', true),
            200
        );
    }

    private function fakeNowPLayingMovies()
    {
        return Http::response(
            json_decode('{"results":[{"popularity":183.316,"vote_count":2413,"video":false,"poster_path":"\/8WUVHemHFH2ZIP6NWkwlHWsyrEL.jpg","id":338762,"adult":false,"backdrop_path":"\/ocUrMYbdjknu2TwzMHKT9PBBQRw.jpg","original_language":"en","original_title":"Bloodshot","genre_ids":[28,878],"title":"Test Fake Movie 2","vote_average":7.1,"overview":"After he and his wife are murdered, marine Ray Garrison is resurrected by a team of scientists. Enhanced with nanotechnology, he becomes a superhuman, biotech killing machine—\'Bloodshot\'. As Ray first trains with fellow super-soldiers, he cannot recall anything from his former life. But when his memories flood back and he remembers the man that killed both him and his wife, he breaks out of the facility to get revenge, only to discover that there\'s more to the conspiracy than he thought.","release_date":"2020-03-05"},{"popularity":97.197,"vote_count":66,"video":false,"poster_path":"\/niyXFhGIk4W2WTcX2Eod8vx2Mfe.jpg","id":686245,"adult":false,"backdrop_path":"\/pPguXG07MDRKH1agJdw1mWzuEkP.jpg","original_language":"en","original_title":"Survive the Night","genre_ids":[28,53],"title":"Survive the Night","vote_average":5.6,"overview":"A disgraced doctor and his family are held hostage at their home by criminals on the run, when a robbery-gone-awry requires them to seek immediate medical attention.","release_date":"2020-05-22"},{"popularity":88.822,"vote_count":7576,"video":false,"poster_path":"\/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg","id":496243,"adult":false,"backdrop_path":"\/ApiBzeaa95TNYliSbQ8pJv4Fje7.jpg","original_language":"ko","original_title":"기생충","genre_ids":[35,18,53],"title":"Parasite","vote_average":8.5,"overview":"All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.","release_date":"2019-05-30"},{"popularity":74.152,"vote_count":1953,"video":false,"poster_path":"\/f4aul3FyD3jv3v4bul1IrkWZvzq.jpg","id":508439,"adult":false,"backdrop_path":"\/xFxk4vnirOtUxpOEWgA1MCRfy6J.jpg","original_language":"en","original_title":"Onward","genre_ids":[12,16,35,14,10751],"title":"Onward","vote_average":7.9,"overview":"In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.","release_date":"2020-02-29"},{"popularity":69.359,"vote_count":485,"video":false,"poster_path":"\/c01Y4suApJ1Wic2xLmaq1QYcfoZ.jpg","id":618344,"adult":false,"backdrop_path":"\/sQkRiQo3nLrQYMXZodDjNUJKHZV.jpg","original_language":"en","original_title":"Justice League Dark: Apokolips War","genre_ids":[28,12,16,14,878],"title":"Justice League Dark: Apokolips War","vote_average":8.5,"overview":"Earth is decimated after intergalactic tyrant Darkseid has devastated the Justice League in a poorly executed war by the DC Super Heroes. Now the remaining bastions of good – the Justice League, Teen Titans, Suicide Squad and assorted others – must regroup, strategize and take the war to Darkseid in order to save the planet and its surviving inhabitants.","release_date":"2020-05-05"},{"popularity":59.67,"vote_count":1214,"video":false,"poster_path":"\/33VdppGbeNxICrFUtW2WpGHvfYc.jpg","id":481848,"adult":false,"backdrop_path":"\/9sXHqZTet3Zg5tgcc0hCDo8Tn35.jpg","original_language":"en","original_title":"The Call of the Wild","genre_ids":[12,18,10751],"title":"The Call of the Wild","vote_average":7.4,"overview":"Buck is a big-hearted dog whose blissful domestic life is turned upside down when he is suddenly uprooted from his California home and transplanted to the exotic wilds of the Yukon during the Gold Rush of the 1890s. As the newest rookie on a mail delivery dog sled team—and later its leader—Buck experiences the adventure of a lifetime, ultimately finding his true place in the world and becoming his own master.","release_date":"2020-02-19"},{"popularity":57.259,"vote_count":3,"video":false,"poster_path":"\/4O25KEus4wc5xj2wJSvvsj2DRuW.jpg","id":696007,"adult":false,"backdrop_path":"\/1xYTUpCutAYgpbqC9Gxw7qIbc0T.jpg","original_language":"en","original_title":"Legacy","genre_ids":[28,53],"title":"Legacy","vote_average":6.7,"overview":"While on a hunting trip in the isolated wilderness, a father and his adopted teenage son are turned into the prey of unknown assailants. They are unexpectedly joined in their fight for ...","release_date":"2020-05-28"},{"popularity":55.513,"vote_count":1181,"video":false,"poster_path":"\/gzlbb3yeVISpQ3REd3Ga1scWGTU.jpg","id":443791,"adult":false,"backdrop_path":"\/ww7eC3BqSbFsyE5H5qMde8WkxJ2.jpg","original_language":"en","original_title":"Underwater","genre_ids":[28,27,878,53],"title":"Underwater","vote_average":6.4,"overview":"After an earthquake destroys their underwater station, six researchers must navigate two miles along the dangerous, unknown depths of the ocean floor to make it to safety in a race against time.","release_date":"2020-01-08"},{"popularity":46.936,"vote_count":3,"video":false,"poster_path":"\/j8MRnCjuN7kpM8w3B5hM5mrvTaE.jpg","id":400160,"adult":false,"backdrop_path":"\/wu1uilmhM4TdluKi2ytfz8gidHf.jpg","original_language":"en","original_title":"The SpongeBob Movie: Sponge on the Run","genre_ids":[12,16,35,14,10751],"title":"The SpongeBob Movie: Sponge on the Run","vote_average":6.7,"overview":"After SpongeBob\'s beloved pet snail Gary is snail-napped, he and Patrick embark on an epic adventure to The Lost City of Atlantic City to bring Gary home.","release_date":"2020-05-28"},{"popularity":45.372,"vote_count":3117,"video":false,"poster_path":"\/8ZX18L5m6rH5viSYpRnTSbb9eXh.jpg","id":619264,"adult":false,"backdrop_path":"\/3tkDMNfM2YuIAJlvGO6rfIzAnfG.jpg","original_language":"es","original_title":"El hoyo","genre_ids":[18,878,53],"title":"The Platform","vote_average":7.1,"overview":"A mysterious place, an indescribable prison, a deep hole. An unknown number of levels. Two inmates living on each level. A descending platform containing food for all of them. An inhuman fight for survival, but also an opportunity for solidarity…","release_date":"2019-11-08"},{"popularity":37.583,"vote_count":2,"video":false,"poster_path":"\/oyG9TL7FcRP4EZ9Vid6uKzwdndz.jpg","id":696374,"adult":false,"backdrop_path":"\/fDTPiqCynPQIkojfzdeyRHpw99S.jpg","original_language":"en","original_title":"Gabriel\'s Inferno","genre_ids":[10749],"title":"Gabriel\'s Inferno","vote_average":2,"overview":"An intriguing and sinful exploration of seduction, forbidden love, and redemption, Gabriel\'s Inferno is a captivating and wildly passionate tale of one man\'s escape from his own personal hell as he tries to earn the impossible--forgiveness and love.","release_date":"2020-05-29"},{"popularity":36.6,"vote_count":1277,"video":false,"poster_path":"\/jtrhTYB7xSrJxR1vusu99nvnZ1g.jpg","id":522627,"adult":false,"backdrop_path":"\/tintsaQ0WLzZsTMkTiqtMB3rfc8.jpg","original_language":"en","original_title":"The Gentlemen","genre_ids":[28,35,80],"title":"The Gentlemen","vote_average":7.7,"overview":"American expat Mickey Pearson has built a highly profitable marijuana empire in London. When word gets out that he’s looking to cash out of the business forever it triggers plots, schemes, bribery and blackmail in an attempt to steal his domain out from under him.","release_date":"2020-01-01"},{"popularity":36.566,"vote_count":2,"video":false,"poster_path":"\/333UycccGJRndunuFXRhQnkIyij.jpg","id":618433,"adult":false,"backdrop_path":"\/3M799IXQ2e54RTSXBOSXWXIK1Y0.jpg","original_language":"en","original_title":"Dead Water","genre_ids":[53],"title":"Dead Water","vote_average":5.5,"overview":"When a relaxing getaway turns deadly, a former Marine must risk his life once again to save his wife and best friend from a modern day pirate; all the while trying to hold himself together as he faces the ghosts of the war he left behind.","release_date":"2020-05-28"},{"popularity":35.633,"vote_count":2,"video":false,"poster_path":"\/m2rJGjlesDKxugl7ypW8n3Mipjl.jpg","id":620883,"adult":false,"backdrop_path":"\/prnq2ONhqo9Tga7dOMZKgFJMofs.jpg","original_language":"es","original_title":"La corazonada","genre_ids":[80,53],"title":"Intuition","vote_average":4,"overview":"Police officer Pipa works on her first big case while simultaneously investigating her boss, who is suspected of murder. The prequel to \"Perdida\".","release_date":"2020-05-28"},{"popularity":33.313,"vote_count":707,"video":false,"poster_path":"\/wxPhn4ef1EAo5njxwBkAEVrlJJG.jpg","id":514847,"adult":false,"backdrop_path":"\/qfQ78ZKiouoM2yhAnfNblp9ijQE.jpg","original_language":"en","original_title":"The Hunt","genre_ids":[28,27,53],"title":"The Hunt","vote_average":6.7,"overview":"Twelve strangers wake up in a clearing. They don\'t know where they are—or how they got there. In the shadow of a dark internet conspiracy theory, ruthless elitists gather at a remote location to hunt humans for sport. But their master plan is about to be derailed when one of the hunted turns the tables on her pursuers.","release_date":"2020-03-11"},{"popularity":32.774,"vote_count":1,"video":false,"poster_path":"\/6mTebYTxlCXTGKY5mY2meHrSedw.jpg","id":572751,"adult":false,"backdrop_path":"\/73uCoGcL849qiAf33a0VbBYcuW6.jpg","original_language":"en","original_title":"Seized","genre_ids":[28,53],"title":"Seized","vote_average":2,"overview":"Carl Rizk, an ex-covert operative who\'s moved to a small quiet town in Oregon to raise his son and daughter gets awakened by a phone call and message from a modulated voice telling him that both his children have been kidnapped and buried alive with just enough air to survive for the next 5 hours. In order to ever see his children alive again, RIZK has to take on three distinct groups of highly-skilled criminals and kill each and every one of them. But he has to work alone and face increasing obstacles and levels of weaponry to uncover the identity of the man behind the macabre plot. The clock is ticking and RIZK can\'t waste any time or make any mistakes or he will lose his family forever.","release_date":"2020-05-28"},{"popularity":32.597,"vote_count":1,"video":false,"poster_path":"\/chGTXsvn53XvEnvsJ9ZD9eiYKx9.jpg","id":635237,"adult":false,"backdrop_path":"\/yOBBzBlN72C6QLtXaskQ87fdVkS.jpg","original_language":"en","original_title":"Arthur & Merlin: Knights of Camelot","genre_ids":[28,12,36],"title":"Arthur & Merlin: Knights of Camelot","vote_average":1,"overview":"Plot to be added.","release_date":"2020-05-28"},{"popularity":32.518,"vote_count":1,"video":false,"poster_path":"\/gVnuN7NLzvsrcV460TscyvRO8vH.jpg","id":670439,"adult":false,"backdrop_path":null,"original_language":"en","original_title":"Six Minutes to Midnight","genre_ids":[18],"title":"Six Minutes to Midnight","vote_average":1,"overview":"Summer 1939. Influential families in Nazi Germany have sent their daughters to a finishing school in an English seaside town to learn the language and be ambassadors for a future looking National Socialist. A teacher there sees what is coming and is trying to raise the alarm. But the authorities believe he is the problem.","release_date":"2020-05-29"},{"popularity":31.597,"vote_count":1250,"video":false,"poster_path":"\/9wvOlM8f3obvG9tNTkpZvF0CUU1.jpg","id":422,"adult":false,"backdrop_path":"\/oNq6WiGDMAvx1ophgAtD6RyajpH.jpg","original_language":"it","original_title":"8½","genre_ids":[18,14],"title":"8½","vote_average":8.3,"overview":"Guido Anselmi, a film director, finds himself creatively barren at the peak of his career. Urged by his doctors to rest, Anselmi heads for a luxurious resort, but a sorry group gathers—his producer, staff, actors, wife, mistress, and relatives—each one begging him to get on with the show. In retreat from their dependency, he fantasizes about past women and dreams of his childhood.","release_date":"1963-02-14"},{"popularity":31.448,"vote_count":697,"video":false,"poster_path":"\/7W0G3YECgDAfnuiHG91r8WqgIOe.jpg","id":446893,"adult":false,"backdrop_path":"\/qsxhnirlp7y4Ae9bd11oYJSX59j.jpg","original_language":"en","original_title":"Trolls World Tour","genre_ids":[12,16,35,14,10402,10751],"title":"Trolls World Tour","vote_average":7.6,"overview":"Queen Poppy and Branch make a surprising discovery — there are other Troll worlds beyond their own, and their distinct differences create big clashes between these various tribes. When a mysterious threat puts all of the Trolls across the land in danger, Poppy, Branch, and their band of friends must embark on an epic quest to create harmony among the feuding Trolls to unite them against certain doom.","release_date":"2020-03-12"}],"page":1,"total_results":632,"dates":{"maximum":"2020-06-03","minimum":"2020-04-16"},"total_pages":32}', true),
            200
        );
    }

    private function fakeGenres()
    {
        return Http::response(
            json_decode('{"genres":[{"id":-1,"name":"Test Fake Genre"},{"id":28,"name":"Action"},{"id":12,"name":"Adventure"},{"id":16,"name":"Animation"},{"id":35,"name":"Comedy"},{"id":80,"name":"Crime"},{"id":99,"name":"Documentary"},{"id":18,"name":"Drama"},{"id":10751,"name":"Family"},{"id":14,"name":"Fantasy"},{"id":36,"name":"History"},{"id":27,"name":"Horror"},{"id":10402,"name":"Music"},{"id":9648,"name":"Mystery"},{"id":10749,"name":"Romance"},{"id":878,"name":"Science Fiction"},{"id":10770,"name":"TV Movie"},{"id":53,"name":"Thriller"},{"id":10752,"name":"War"},{"id":37,"name":"Western"}]}', true),
            200
        );
    }
}
