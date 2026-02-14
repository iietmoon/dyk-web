<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageUrls = $this->fetchRandomImageUrls(40);
        $facts = $this->getDidYouKnowFacts();

        $now = now();
        $usedSlugs = [];

        foreach ($facts as $index => $fact) {
            $title = $fact['title'];
            $slug = Str::slug($title);
            if (in_array($slug, $usedSlugs, true)) {
                $slug = $slug . '-' . ($index + 1);
            }
            $usedSlugs[] = $slug;

            Article::create([
                'user_id' => null,
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $fact['excerpt'],
                'body' => $fact['body'],
                'image' => $imageUrls[$index] ?? 'https://picsum.photos/800/600?random=' . ($index + 1),
                'status' => 'published',
                'published_at' => $now->copy()->subDays(40 - $index),
                'topics' => $fact['topics'],
                'meta' => null,
                'is_featured' => $index < 5,
                'sort_order' => $index,
                'view_count' => random_int(10, 5000),
            ]);
        }
    }

    /**
     * Fetch image URLs from Picsum Photos API.
     *
     * @return array<int, string>
     */
    private function fetchRandomImageUrls(int $count): array
    {
        $urls = [];
        $perPage = 30;
        $page = 1;

        while (count($urls) < $count) {
            $response = Http::timeout(10)->get('https://picsum.photos/v2/list', [
                'page' => $page,
                'limit' => min($perPage, $count - count($urls)),
            ]);

            if (! $response->successful()) {
                for ($i = count($urls); $i < $count; $i++) {
                    $urls[] = 'https://picsum.photos/seed/' . Str::random(8) . '/800/600';
                }
                break;
            }

            $data = $response->json();
            if (empty($data)) {
                break;
            }
            foreach ($data as $item) {
                $urls[] = $item['download_url'] ?? 'https://picsum.photos/800/600';
                if (count($urls) >= $count) {
                    break;
                }
            }
            $page++;
            if (count($data) < $perPage) {
                break;
            }
        }

        while (count($urls) < $count) {
            $urls[] = 'https://picsum.photos/seed/' . Str::random(8) . '/800/600';
        }

        return array_slice($urls, 0, $count);
    }

    /**
     * @return array<int, array{title: string, excerpt: string, body: string, topics: array<string>}>
     */
    private function getDidYouKnowFacts(): array
    {
        return [
            [
                'title' => 'Did you know how money works?',
                'excerpt' => 'Money is a medium of exchange that allows us to trade goods and services without bartering.',
                'body' => 'Money is a medium of exchange that allows us to trade goods and services without bartering. Central banks control the supply of money to keep economies stable. Today, most money exists only digitally in bank systems.',
                'topics' => ['money', 'economy', 'finance'],
            ],
            [
                'title' => 'Did you know how Morocco succeeded in football?',
                'excerpt' => 'Morocco became the first African and Arab nation to reach the World Cup semi-finals in 2022.',
                'body' => 'Morocco became the first African and Arab nation to reach the World Cup semi-finals in 2022. Their success came from strong defence, team spirit, and a generation of players developed in European leagues. They beat Belgium, Spain, and Portugal on the way.',
                'topics' => ['sports', 'football', 'morocco'],
            ],
            [
                'title' => 'Did you know that honey never spoils?',
                'excerpt' => 'Archaeologists have found edible honey in ancient Egyptian tombs over 3,000 years old.',
                'body' => 'Archaeologists have found edible honey in ancient Egyptian tombs over 3,000 years old. Honey’s low water content and high acidity prevent bacteria and mould from growing. When stored in a sealed container, it can last almost indefinitely.',
                'topics' => ['science', 'food', 'history'],
            ],
            [
                'title' => 'Did you know that the shortest war lasted 38 minutes?',
                'excerpt' => 'The Anglo-Zanzibar War of 1896 is the shortest recorded war in history.',
                'body' => 'The Anglo-Zanzibar War of 1896 is the shortest recorded war in history. It lasted about 38 minutes. The British Royal Navy bombarded the sultan’s palace after an ultimatum was ignored. Zanzibar surrendered quickly.',
                'topics' => ['history', 'war', 'facts'],
            ],
            [
                'title' => 'Did you know how clouds form?',
                'excerpt' => 'Clouds form when water vapour in the air cools and condenses into tiny droplets or ice crystals.',
                'body' => 'Clouds form when water vapour in the air cools and condenses into tiny droplets or ice crystals. This often happens when warm air rises and cools. The shape and height of clouds depend on temperature, humidity, and wind.',
                'topics' => ['science', 'weather', 'nature'],
            ],
            [
                'title' => 'Did you know that octopuses have three hearts?',
                'excerpt' => 'Two hearts pump blood to the gills, and one pumps it to the rest of the body.',
                'body' => 'Two hearts pump blood to the gills, and one pumps it to the rest of the body. When an octopus swims, the heart that feeds the body stops, which is why they prefer crawling to swimming. Their blood is blue because it uses copper instead of iron.',
                'topics' => ['nature', 'animals', 'science'],
            ],
            [
                'title' => 'Did you know how the Great Wall of China was built?',
                'excerpt' => 'The wall was built over many centuries by soldiers, peasants, and prisoners.',
                'body' => 'The wall was built over many centuries by soldiers, peasants, and prisoners. Materials included stone, brick, wood, and tamped earth. It was designed to protect against invasions from the north. Today it stretches over 21,000 km including all its branches.',
                'topics' => ['history', 'china', 'architecture'],
            ],
            [
                'title' => 'Did you know that bananas are berries?',
                'excerpt' => 'In botany, a berry is a fruit produced from a single ovary. Bananas qualify; strawberries do not.',
                'body' => 'In botany, a berry is a fruit produced from a single ovary. Bananas qualify; strawberries do not. Raspberries and blackberries are “aggregate fruits,” not true berries. So the banana is a berry, and the strawberry is not.',
                'topics' => ['science', 'food', 'nature'],
            ],
            [
                'title' => 'Did you know how sleep affects your brain?',
                'excerpt' => 'During sleep the brain clears waste, stores memories, and restores energy.',
                'body' => 'During sleep the brain clears waste, stores memories, and restores energy. Poor sleep is linked to worse focus, mood, and long-term health. Most adults need seven to nine hours per night for the brain to do this maintenance properly.',
                'topics' => ['health', 'science', 'brain'],
            ],
            [
                'title' => 'Did you know that the Eiffel Tower grows in summer?',
                'excerpt' => 'The iron structure can expand by up to about 15 cm in hot weather.',
                'body' => 'The iron structure can expand by up to about 15 cm in hot weather. Heat makes the metal expand; cold makes it shrink. So the tower is slightly taller in summer and shorter in winter. The same happens with many large metal structures.',
                'topics' => ['science', 'paris', 'architecture'],
            ],
            [
                'title' => 'Did you know how coffee spread around the world?',
                'excerpt' => 'Coffee started in Ethiopia, then spread through the Middle East, Europe, and the Americas.',
                'body' => 'Coffee started in Ethiopia, then spread through the Middle East, Europe, and the Americas. By the 17th century it was popular in Europe. Today Brazil is the largest producer. The drink’s spread is tied to trade, travel, and colonialism.',
                'topics' => ['history', 'food', 'culture'],
            ],
            [
                'title' => 'Did you know that a day on Venus is longer than its year?',
                'excerpt' => 'Venus takes 243 Earth days to rotate once but only 225 Earth days to orbit the Sun.',
                'body' => 'Venus takes 243 Earth days to rotate once but only 225 Earth days to orbit the Sun. So one “day” on Venus is longer than one “year.” The planet also rotates in the opposite direction to most planets in our solar system.',
                'topics' => ['science', 'space', 'astronomy'],
            ],
            [
                'title' => 'Did you know how tattoos stay in the skin?',
                'excerpt' => 'Ink is deposited in the dermis, the second layer of skin, which is stable and does not shed.',
                'body' => 'Ink is deposited in the dermis, the second layer of skin, which is stable and does not shed. The outer layer, the epidermis, constantly renews itself, but the dermis keeps the ink. Immune cells called macrophages also “hold” some of the ink in place.',
                'topics' => ['science', 'body', 'culture'],
            ],
            [
                'title' => 'Did you know that Iceland has no mosquitoes?',
                'excerpt' => 'Iceland is one of the few places in the world where mosquitoes are not found.',
                'body' => 'Iceland is one of the few places in the world where mosquitoes are not found. The climate is too cold and unstable for them to complete their life cycle. So you can enjoy Icelandic summer evenings without mosquito bites.',
                'topics' => ['nature', 'geography', 'facts'],
            ],
            [
                'title' => 'Did you know how diamonds are formed?',
                'excerpt' => 'Diamonds form deep underground when carbon is subjected to very high pressure and temperature.',
                'body' => 'Diamonds form deep underground when carbon is subjected to very high pressure and temperature. They are brought to the surface by volcanic eruptions in kimberlite pipes. The process can take billions of years. That is why natural diamonds are so rare and valuable.',
                'topics' => ['science', 'nature', 'geology'],
            ],
            [
                'title' => 'Did you know that the human heart beats about 100,000 times per day?',
                'excerpt' => 'That adds up to roughly 2.5 billion beats in an average lifetime.',
                'body' => 'That adds up to roughly 2.5 billion beats in an average lifetime. The heart pumps blood through about 96,000 km of blood vessels. It works without rest from before birth until death. Keeping it healthy with exercise and diet is one of the best things you can do.',
                'topics' => ['health', 'science', 'body'],
            ],
            [
                'title' => 'Did you know how the internet was invented?',
                'excerpt' => 'The first version, ARPANET, was created in the late 1960s for military and research use.',
                'body' => 'The first version, ARPANET, was created in the late 1960s for military and research use. Tim Berners-Lee later invented the World Wide Web in 1989. Today the internet connects billions of devices and people around the world.',
                'topics' => ['technology', 'history', 'internet'],
            ],
            [
                'title' => 'Did you know that flamingos are pink because of their diet?',
                'excerpt' => 'They eat algae and shrimp that contain pigments called carotenoids.',
                'body' => 'They eat algae and shrimp that contain pigments called carotenoids. Without these foods, their feathers would be white or grey. Young flamingos are grey and turn pink as they grow and eat the same diet. So their colour is literally from what they eat.',
                'topics' => ['nature', 'animals', 'science'],
            ],
            [
                'title' => 'Did you know how snowflakes get their shape?',
                'excerpt' => 'Each snowflake forms when water vapour freezes around a tiny dust particle in a unique way.',
                'body' => 'Each snowflake forms when water vapour freezes around a tiny dust particle in a unique way. Temperature and humidity decide whether you get plates, needles, or branched crystals. Because the path through the cloud is different for each one, no two snowflakes are exactly alike.',
                'topics' => ['science', 'weather', 'nature'],
            ],
            [
                'title' => 'Did you know that the Sahara was once green?',
                'excerpt' => 'Thousands of years ago the Sahara had lakes, rivers, and grasslands.',
                'body' => 'Thousands of years ago the Sahara had lakes, rivers, and grasslands. Climate change turned it into the desert we see today. This happened over thousands of years as the Earth’s orbit and tilt changed. Some rock art in the Sahara shows animals that needed water and plants to survive.',
                'topics' => ['history', 'climate', 'geography'],
            ],
            [
                'title' => 'Did you know how vaccines work?',
                'excerpt' => 'Vaccines train the immune system to recognise and fight a disease without causing the full illness.',
                'body' => 'Vaccines train the immune system to recognise and fight a disease without causing the full illness. They often use weakened or inactivated germs or pieces of them. The body then makes antibodies and “remembers” the germ. So when the real germ appears, the body can respond quickly.',
                'topics' => ['health', 'science', 'medicine'],
            ],
            [
                'title' => 'Did you know that a group of crows is called a murder?',
                'excerpt' => 'Many animal groups have unusual collective nouns from old English tradition.',
                'body' => 'Many animal groups have unusual collective nouns from old English tradition. Other examples: a pride of lions, a pod of dolphins, a parliament of owls. These terms were popularised in books and have stuck in the language ever since.',
                'topics' => ['language', 'animals', 'culture'],
            ],
            [
                'title' => 'Did you know how chocolate is made?',
                'excerpt' => 'Chocolate comes from cacao beans that are fermented, dried, roasted, and ground.',
                'body' => 'Chocolate comes from cacao beans that are fermented, dried, roasted, and ground. The paste is mixed with sugar and sometimes milk to make the chocolate we eat. The cacao tree grows mainly in tropical regions near the equator. The process from bean to bar takes several steps and a lot of skill.',
                'topics' => ['food', 'science', 'culture'],
            ],
            [
                'title' => 'Did you know that light takes about 8 minutes to reach Earth from the Sun?',
                'excerpt' => 'The Sun is roughly 150 million kilometres away from Earth.',
                'body' => 'The Sun is roughly 150 million kilometres away from Earth. Light travels at nearly 300,000 km per second. So when you see the Sun, you are seeing it as it was about 8 minutes ago. For farther stars, we see them as they were years or even billions of years ago.',
                'topics' => ['science', 'space', 'astronomy'],
            ],
            [
                'title' => 'Did you know how cats always land on their feet?',
                'excerpt' => 'Cats have a “righting reflex” and a flexible spine that help them twist in mid-air.',
                'body' => 'Cats have a “righting reflex” and a flexible spine that help them twist in mid-air. They can sense which way is up and rotate their body to land on their feet. This does not mean falls are safe—high falls can still injure or kill a cat. So keep windows and balconies secure.',
                'topics' => ['animals', 'science', 'nature'],
            ],
            [
                'title' => 'Did you know that the first computer bug was a real insect?',
                'excerpt' => 'In 1947 a moth was found stuck in a relay of the Harvard Mark II computer.',
                'body' => 'In 1947 a moth was found stuck in a relay of the Harvard Mark II computer. The team logged it as the first “bug” in the system. The word “debugging” had been used before, but this event made the term famous. The moth is now in the Smithsonian.',
                'topics' => ['technology', 'history', 'facts'],
            ],
            [
                'title' => 'Did you know how the Pyramids were built?',
                'excerpt' => 'The Great Pyramid was built with huge stone blocks, likely moved on sleds and ramps.',
                'body' => 'The Great Pyramid was built with huge stone blocks, likely moved on sleds and ramps. Workers were probably paid labourers, not slaves. How exactly the largest blocks were lifted is still debated. The construction used millions of blocks and took many years.',
                'topics' => ['history', 'egypt', 'architecture'],
            ],
            [
                'title' => 'Did you know that your stomach gets a new lining every few days?',
                'excerpt' => 'Stomach acid is so strong that the body has to replace the inner lining often.',
                'body' => 'Stomach acid is so strong that the body has to replace the inner lining often. Otherwise the acid would damage the stomach. Mucus and rapid cell renewal protect the wall. So your stomach is constantly renewing itself to stay healthy.',
                'topics' => ['health', 'science', 'body'],
            ],
            [
                'title' => 'Did you know how rainbows form?',
                'excerpt' => 'Rainbows appear when sunlight is refracted and reflected inside raindrops.',
                'body' => 'Rainbows appear when sunlight is refracted and reflected inside raindrops. Each colour of light bends at a slightly different angle, so we see a band of colours. You see a rainbow when the Sun is behind you and rain is in front of you. Double rainbows happen when light reflects twice inside the drops.',
                'topics' => ['science', 'weather', 'nature'],
            ],
            [
                'title' => 'Did you know that Japan has a square watermelon?',
                'excerpt' => 'Farmers grow them in glass boxes so they take the shape of the container.',
                'body' => 'Farmers grow them in glass boxes so they take the shape of the container. Square watermelons are easier to stack and store. They are mostly a novelty and can cost much more than normal ones. They are popular as gifts in Japan.',
                'topics' => ['food', 'japan', 'culture'],
            ],
            [
                'title' => 'Did you know how birds know where to migrate?',
                'excerpt' => 'They use the Sun, stars, Earth’s magnetic field, and landmarks to navigate.',
                'body' => 'They use the Sun, stars, Earth’s magnetic field, and landmarks to navigate. Some species can sense magnetic fields with special cells in their eyes or beak. Young birds often learn the route by following older ones. Migration is one of the most impressive feats in the animal kingdom.',
                'topics' => ['nature', 'animals', 'science'],
            ],
            [
                'title' => 'Did you know that the smell of rain has a name?',
                'excerpt' => 'It is called “petrichor”—from the Greek for “stone” and “fluid of the gods.”',
                'body' => 'It is called “petrichor”—from the Greek for “stone” and “fluid of the gods.” The smell comes from oils that plants release into the soil and from a compound produced by soil bacteria. When rain hits the ground, these are released into the air. Many people find the smell calming and pleasant.',
                'topics' => ['science', 'nature', 'language'],
            ],
            [
                'title' => 'Did you know how the brain stores memories?',
                'excerpt' => 'Memories are stored through changes in connections between neurons.',
                'body' => 'Memories are stored through changes in connections between neurons. Different brain areas handle short-term and long-term memory. Sleep helps move memories from short-term to long-term storage. That is why good sleep is so important for learning and remembering.',
                'topics' => ['science', 'brain', 'health'],
            ],
            [
                'title' => 'Did you know that the longest place name has 85 letters?',
                'excerpt' => 'A hill in New Zealand has the longest official place name in the world.',
                'body' => 'A hill in New Zealand has the longest official place name in the world. In Māori it is “Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu.” It refers to the place where Tamatea played his flute for his loved one. Locals often shorten it to “Taumata” for convenience.',
                'topics' => ['geography', 'language', 'culture'],
            ],
            [
                'title' => 'Did you know how soap cleans your hands?',
                'excerpt' => 'Soap molecules have one end that binds to water and one that binds to oil and grease.',
                'body' => 'Soap molecules have one end that binds to water and one that binds to oil and grease. When you wash, the soap pulls germs and dirt off your skin so they can be rinsed away. Soap also breaks down some germs’ outer layers. That is why washing with soap is more effective than water alone.',
                'topics' => ['science', 'health', 'hygiene'],
            ],
            [
                'title' => 'Did you know that giraffes have the same number of neck bones as humans?',
                'excerpt' => 'Both have seven vertebrae; a giraffe’s are just much longer.',
                'body' => 'Both have seven vertebrae; a giraffe’s are just much longer. Each giraffe neck bone can be over 25 cm long. Their long necks help them reach leaves high in trees. So the difference is size, not number of bones.',
                'topics' => ['animals', 'science', 'nature'],
            ],
            [
                'title' => 'Did you know how fireworks get their colours?',
                'excerpt' => 'Different metal compounds produce different colours when they burn.',
                'body' => 'Different metal compounds produce different colours when they burn. Strontium gives red, copper gives blue, sodium gives yellow, and so on. Firework makers mix these chemicals to create the patterns and colours we see. The art has been refined over centuries.',
                'topics' => ['science', 'chemistry', 'culture'],
            ],
            [
                'title' => 'Did you know that the first email was sent in 1971?',
                'excerpt' => 'Ray Tomlinson sent it to himself as a test on the ARPANET.',
                'body' => 'Ray Tomlinson sent it to himself as a test on the ARPANET. He also chose the @ symbol to separate the user name from the computer name. That format is still used in email addresses today. Billions of emails are now sent every day.',
                'topics' => ['technology', 'history', 'internet'],
            ],
            [
                'title' => 'Did you know how trees communicate?',
                'excerpt' => 'Trees can share nutrients and signals through underground fungal networks.',
                'body' => 'Trees can share nutrients and signals through underground fungal networks. Scientists call this the “wood wide web.” Older “mother” trees can help younger ones by sending them carbon and other resources. They can also send warning signals about pests or drought.',
                'topics' => ['nature', 'science', 'environment'],
            ],
            [
                'title' => 'Did you know that the first camera phone was sold in 2000?',
                'excerpt' => 'The Sharp J-SH04 in Japan was the first phone with a built-in camera.',
                'body' => 'The Sharp J-SH04 in Japan was the first phone with a built-in camera. It had a 0.11-megapixel sensor. Today smartphone cameras have hundreds of times more resolution. The camera phone changed how we share and document our lives.',
                'topics' => ['technology', 'history', 'photography'],
            ],
            [
                'title' => 'Did you know how the Moon affects the tides?',
                'excerpt' => 'The Moon’s gravity pulls on the ocean, creating bulges that we see as high and low tides.',
                'body' => 'The Moon’s gravity pulls on the ocean, creating bulges that we see as high and low tides. The Sun also has a smaller effect. When the Sun and Moon align, we get spring tides (higher highs and lower lows). When they are at right angles, we get neap tides.',
                'topics' => ['science', 'space', 'nature'],
            ],
            [
                'title' => 'Did you know that the first video uploaded to YouTube was in 2005?',
                'excerpt' => 'It was “Me at the zoo,” 19 seconds long, uploaded by a co-founder.',
                'body' => 'It was “Me at the zoo,” 19 seconds long, uploaded by a co-founder. YouTube was sold to Google the next year. Today billions of videos are watched every day. That first clip is still on the site and has been viewed millions of times.',
                'topics' => ['technology', 'history', 'internet'],
            ],
            [
                'title' => 'Did you know how popcorn pops?',
                'excerpt' => 'Each kernel has a small amount of water inside that turns to steam when heated.',
                'body' => 'Each kernel has a small amount of water inside that turns to steam when heated. The steam builds pressure until the hard shell bursts. The starch inside puffs up and cools into the fluffy white shape we eat. Not all corn varieties pop—only those with the right kind of hull and moisture.',
                'topics' => ['food', 'science', 'facts'],
            ],
        ];
    }
}
