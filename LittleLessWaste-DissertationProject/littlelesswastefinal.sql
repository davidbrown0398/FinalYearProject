-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 08, 2023 at 02:30 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `littlelesswaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `llw_admin`
--

CREATE TABLE `llw_admin` (
  `admin_id` int(11) NOT NULL,
  `admin` varchar(255) NOT NULL,
  `email_address` text NOT NULL,
  `pword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_admin`
--

INSERT INTO `llw_admin` (`admin_id`, `admin`, `email_address`, `pword`) VALUES
(1, 'daveadmin', 'dbrown41@qub.ac.uk', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `llw_article`
--

CREATE TABLE `llw_article` (
  `article_id` int(11) NOT NULL,
  `article_name` varchar(250) NOT NULL,
  `article_type` varchar(100) NOT NULL,
  `article_description` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_article`
--

INSERT INTO `llw_article` (`article_id`, `article_name`, `article_type`, `article_description`, `img`) VALUES
(11, 'UK must prioritise food security warns NFU', 'News', 'Food shortages could last for weeks, says the National Farmers’ Union (NFU), as poor weather in Europe and north Africa has impacted food supply.\r\n\r\nBrexit and high energy bills impacting British glass houses have also contributed to the situation, according to NFU deputy president Tom Bradshaw.\r\n\r\nHe added that the UK could ‘hit a tipping point’ where the government needs to increase food security and ‘take command of the food we produce’.\r\n‘We’ve been warning about this moment for the past year,’ Bradshaw told Times Radio. ‘The tragic events in Ukraine have driven inflation, particularly energy inflation, to levels that we haven’t seen before.\r\n\r\n‘There’s a lack of confidence from the growers that they’re going to get the returns that justify planting their glasshouses, and at the moment we’ve got a lot of glasshouses that would be growing the tomatoes, peppers, cucumbers, aubergine that are sitting there empty because they simply couldn’t take the risk to plant them with the crops, not thinking they’d get the returns from the marketplace.\r\n\r\n‘And with them being completely reliant on imports – we’d always have some imports – but we’ve been completely reliant on imports [now]. And when there’s been some shock weather events in Morocco and Spain, it’s meant that we’ve had these shortages.’\r\n\r\nBradshaw noted that the UK had had to go further afield to source fruit and vegetables since Brexit, with produce now being imported regularly from Morocco where climate events are more prevalent.\r\n\r\nSeveral supermarkets including Tesco, Aldi, Morrisons and Asda have been forced to bring in customer limits on fruit and veg to ensure shelves remain stocked up.\r\n\r\nCustomers have been complaining on Twitter about empty shelves, as tomatoes, cucumber, raspberries, salad and broccoli are in short supply.\r\n\r\nScientists have warned that the climate crisis could jeopardise the world’s food security, as extreme weather and high temperatures lead to drought and unsurvivable conditions for crops.\r\n\r\nBut increasing biodiversity could help to mitigate some of this, as last year, a study found that pollinators can stabilise crop yields and help to reduce food prices.', 'https://environmentjournal.online/wp-content/uploads/sites/5/2023/02/s9xe5omkj2q.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `llw_favourite_recipe`
--

CREATE TABLE `llw_favourite_recipe` (
  `favourite_recipe_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_favourite_recipe`
--

INSERT INTO `llw_favourite_recipe` (`favourite_recipe_id`, `recipe_id`, `user_id`) VALUES
(36, 1, 1),
(37, 2, 1),
(38, 3, 1),
(39, 10, 1),
(40, 1, 7),
(60, 9, 13),
(63, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `llw_food`
--

CREATE TABLE `llw_food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_food`
--

INSERT INTO `llw_food` (`food_id`, `food_name`, `user_id`) VALUES
(1, 'Salmon', '1'),
(3, 'Trout', '1'),
(4, 'Cod', '1'),
(5, 'Squid', '1'),
(6, 'Prawns', '1'),
(8, 'Beef Sausages', '1'),
(9, 'Chicken Breast', '1'),
(10, 'Chicken Liver', '1'),
(16, 'Beans', '1'),
(18, 'Eggs', '1'),
(19, 'Apple', '1'),
(20, 'Potatoes', '1'),
(21, 'Sourdough Bread', '1'),
(23, 'Black Beans', '1'),
(27, 'Kidney Beans', '1'),
(28, 'Orange', '1'),
(30, 'Celery', '1'),
(33, 'Lentils', '1'),
(35, 'Milk', '1');

-- --------------------------------------------------------

--
-- Table structure for table `llw_food_category`
--

CREATE TABLE `llw_food_category` (
  `food_category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_food_category`
--

INSERT INTO `llw_food_category` (`food_category_id`, `category_name`) VALUES
(1, 'Meat'),
(2, 'Fish'),
(3, 'Carbohydrates'),
(4, 'Fruit/Veg'),
(5, 'Diary'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `llw_food_wasted`
--

CREATE TABLE `llw_food_wasted` (
  `food_wasted_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_food_wasted`
--

INSERT INTO `llw_food_wasted` (`food_wasted_id`, `user_id`, `food_id`, `food_category_id`) VALUES
(1, 1, 19, 4),
(2, 1, 8, 1),
(3, 1, 20, 3),
(4, 1, 5, 2),
(5, 1, 35, 5),
(6, 1, 9, 1),
(17, 1, 28, 4),
(18, 7, 35, 5),
(21, 9, 4, 2),
(23, 4, 8, 1),
(24, 4, 1, 2),
(25, 13, 1, 2),
(27, 13, 1, 2),
(28, 13, 1, 2),
(29, 13, 8, 1),
(30, 13, 19, 4),
(31, 13, 1, 2),
(32, 13, 1, 2),
(33, 13, 1, 1),
(34, 13, 20, 3),
(35, 13, 28, 4),
(36, 13, 4, 2),
(37, 13, 1, 2),
(38, 13, 1, 2),
(39, 13, 6, 3),
(42, 40, 1, 2),
(43, 40, 9, 1),
(44, 41, 1, 2),
(45, 41, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `llw_recipe`
--

CREATE TABLE `llw_recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_recipe`
--

INSERT INTO `llw_recipe` (`recipe_id`, `recipe_name`, `ingredients`, `instructions`) VALUES
(1, 'Chicken Korma', '1 onion, chopped\n2 garlic cloves, roughly chopped\nthumb-sized piece ginger, roughly chopped\n4 tbsp korma paste\n4 skinless, boneless chicken breasts, cut into bite-sized pieces\n50g ground almonds, plus extra to serve (optional)\n4 tbsp sultanas\n400ml chicken stock\n¼ tsp golden caster sugar\n150g pot 0% fat Greek yogurt\nsmall bunch coriander, chopped', 'STEP 1\nPut 1 chopped onion, 2 roughly chopped garlic cloves and a roughly chopped thumb-sized piece of ginger in a food processor and whizz to a paste.\n\nSTEP 2\nTip the paste into a large high-sided frying pan with 3 tbsp water and cook for 5 mins. Add 4 tbsp korma paste and cook for a further 2 mins until aromatic.\n\nSTEP 3\nStir 4 skinless, boneless chicken breasts, cut into bite-sized pieces, into the sauce. Add 50g ground almonds, 4 tbsp sultanas, 400ml chicken stock and ¼ tsp golden caster sugar.\n\nSTEP 4\nGive everything a good mix, then cover and simmer for 10 mins or until the chicken is cooked through.\n\nSTEP 5\nRemove the pan from the heat, stir in a 150g pot Greek yogurt and some seasoning, then scatter over a small bunch of chopped coriander and more ground almonds, if using. Serve with brown or white basmati rice'),
(2, 'Chicken Madras', '1 onion, peeled and quartered\n2 garlic cloves\nthumb-sized chunk of ginger, peeled\n½ red chilli\n1 tbsp vegetable oil\n½ tsp turmeric\n1 tsp ground cumin\n1 tsp ground coriander\n1-2 tsp hot chilli powder (depending on how spicy you like your curry)\n4 chicken breasts, cut into chunks\n400g can chopped tomatoes\nsmall pack coriander, chopped\nrice, naan and mango chutney, to serve', 'STEP 1\r\nBlitz 1 quartered onion, 2 garlic cloves, a thumb-sized chunk of ginger and ½ red chilli together in a food processor until it becomes a coarse paste.\r\n\r\nSTEP 2\r\nHeat 1 tbsp vegetable oil in a large saucepan and add the paste, fry for 5 mins, until softened. If it starts to stick to the pan at all, add a splash of water.\r\n\r\nSTEP 3\r\nTip in ½ tsp turmeric, 1 tsp ground cumin, 1 tsp ground coriander and 1-2 tsp hot chilli powder and stir well, cook for a couple of mins to toast them a bit, then add 4 chicken breasts, cut into chunks. Stir and make sure everything is covered in the spice mix.\r\n\r\nSTEP 4\r\nCook until the chicken begins to turn pale, adding a small splash of water if it sticks to the base of the pan at all.\r\n\r\nSTEP 5\r\nPour in 400g can chopped tomatoes, along with a big pinch of salt, cover and cook on a low heat for 30 mins, until the chicken is tender.\r\n\r\nSTEP 6\r\nStir through small pack of coriander and serve with rice, naan and a big dollop of mango chutney.'),
(3, 'Fruity Caribbean Curry', '2 tsp vegetable or sunflower oil\r\n4 chicken drumsticks, skin removed\r\n2 large red onions, chopped\r\n2 peppers (any colours will do), chopped\r\n3-4 tbsp mild curry powder\r\n425g can pineapple chunks in unsweetened juice\r\n400g can coconut milk\r\n400g can kidney beans, drained\r\n2-4 tbsp hot pepper sauce (depending on how hot you like it)\r\nsmall bunch coriander, chopped\r\ncooked rice, to serve (we used Tilda coconut rice)', 'STEP 1\r\nHeat the oil in a large frying pan. Add the chicken and brown well on all sides, then transfer to a plate. Add the onions and peppers to the pan, and cook for 5 mins until the veg starts to soften. Return the chicken to the pan and sprinkle in the curry powder, then add the pineapple with its juice, and the coconut milk. Season and simmer, uncovered, for 40 mins until the chicken is tender and the sauce has reduced and thickened a little.\r\n\r\nSTEP 2\r\nAdd the beans and pepper sauce to the pan. Simmer for another 2-3 mins until the beans are warmed through, then scatter with coriander and serve with cooked rice.'),
(4, 'Chickpea Curry', 'For the paste\r\n2 tbsp oil\r\n1 onion, diced\r\n1 tsp fresh or dried chilli, to taste\r\n9 garlic cloves (approx 1 small bulb of garlic)\r\nthumb-sized piece ginger, peeled\r\n1 tbsp ground coriander\r\n2 tbsp ground cumin\r\n1 tbsp garam masala\r\n2 tbsp tomato purée\r\nFor the curry\r\n2 x 400g cans chickpeas, drained\r\n400g can chopped tomatoes\r\n100g creamed coconut\r\n½ small pack coriander, chopped, plus extra to garnish\r\n100g spinach\r\nTo serve\r\ncooked rice and/or dahl', 'STEP 1\r\nTo make the paste, heat a little of the 2 tbsp oil in a frying pan, add 1 diced onion and 1 tsp fresh or dried chilli, and cook until softened, about 8 mins.\r\n\r\nSTEP 2\r\nIn a food processor, combine 9 garlic cloves, a thumb-sized piece of peeled ginger and the remaining oil, then add 1 tbsp ground coriander, 2 tbsp ground cumin, 1 tbsp garam masala, 2 tbsp tomato purée, ½ tsp salt and the fried onion. Blend to a smooth paste – add a drop of water or more oil, if needed.\r\n\r\nSTEP 3\r\nCook the paste in a medium saucepan for 2 mins over a medium-high heat, stirring occasionally so it doesn’t stick.\r\n\r\nSTEP 4\r\nTip in two 400g cans drained chickpeas and a 400g can chopped tomatoes, and simmer for 5 mins until reduced down.\r\n\r\nSTEP 5\r\nAdd 100g creamed coconut with a little water, cook for 5 mins more, then add ½ small pack chopped coriander and 100g spinach, and cook until wilted.\r\n\r\nSTEP 6\r\nGarnish with extra coriander and serve with rice or dhal (or both).\r\n\r\n'),
(5, 'One Pan Pasta', '1 tbsp rapeseed oil\n12 meatballs (300g)\n1 onion, finely chopped\n3 garlic cloves, finely chopped\n2 tbsp ketchup\n2 x 400g cans chopped tomatoes\n1 large bunch of basil, finely chopped, plus a few whole leaves\n225g dried spaghetti', 'STEP 1\r\nHeat the oil in a deep, wide frying pan or casserole dish over a medium-high heat. Tip in the meatballs and cook for 5 mins, turning until browned all over. Add the onion and garlic, and fry for 8 more mins until softened.\r\n\r\nSTEP 2\r\nAdd the ketchup, chopped tomatoes, chopped basil and 400ml water to the pan and bring to the boil. Add the spaghetti and cook for 10-12 mins, stirring occasionally. When the pasta is cooked and the sauce has reduced, season and sprinkle with the basil leaves to serve.'),
(6, 'Sausage Ragu', '3 tbsp olive oil\r\n1 onion, finely chopped\r\n2 large garlic cloves, crushed\r\n¼ tsp chilli flakes\r\n2 rosemary sprigs, leaves finely chopped\r\n2 x 400g cans chopped tomatoes\r\n1 tbsp brown sugar\r\n6 pork sausages\r\n150ml whole milk\r\n1 lemon, zested\r\n350g rigatoni pasta\r\ngrated parmesan and ½ small bunch parsley, leaves roughly chopped, to serve', 'STEP 1\r\nHeat 2 tbsp of the oil in a saucepan over a medium heat. Fry the onion with a pinch of salt for 7 mins. Add the garlic, chilli and rosemary, and cook for 1 min more. Tip in the tomatoes and sugar, and simmer for 20 mins.\r\n\r\nSTEP 2\r\nHeat the remaining oil in a medium frying pan over a medium heat. Squeeze the sausagemeat from the skins and fry, breaking it up with a wooden spoon, for 5-7 mins until golden. Add to the sauce with the milk and lemon zest, then simmer for a further 5 mins. To freeze, leave to cool completely and transfer to large freezerproof bags.\r\n\r\nSTEP 3\r\nCook the pasta following pack instructions. Drain and toss with the sauce. Scatter over the parmesan and parsley leaves to serve.'),
(7, 'Tomato & Pasta Soup', 'Ingredients\r\n2 tbsp olive oil\r\n1 onion, chopped\r\n2 celery sticks, chopped\r\n2 garlic cloves, crushed\r\n1 tbsp tomato purée\r\n400g can chopped tomatoes\r\n400g can chickpeas\r\n150g orzo or other small pasta shapes\r\n700ml vegetable stock\r\n2 tbsp basil pesto\r\ncrusty bread, to serve', 'STEP 1\r\nHeat 1 tbsp olive oil in a large saucepan. Add the onion and celery and fry for 10-15 mins, or until starting to soften, then add the garlic and cook for 1 min more. Stir in all the other ingredients, except for the pesto and remaining oil, and bring to the boil.\r\n\r\nSTEP 2\r\nReduce the heat and leave to simmer for 6-8 mins, or until the pasta is tender. Season to taste, then ladle into bowls.\r\n\r\nSTEP 3\r\nStir the remaining oil with the pesto, then drizzle over the soup. Serve with chunks of crusty bread.'),
(8, 'Vegan Salad Bowl', '200g couscous\r\n400g can mixed beans\r\n1 tsp olive oil\r\n1⁄2 tsp chilli flakes\r\n3⁄4 small bunch of dill, torn into sprigs\r\n2 watermelon radishes or 6 small ones, sliced\r\n1⁄2 cucumber, peeled into ribbons\r\nFor the quick pickle\r\n1 large red onion, finely sliced\r\n1⁄4 small red cabbage, finely sliced\r\n2 tbsp white wine vinegar or apple cider vinegar\r\n1 tbsp caster sugar\r\n1⁄4 small bunch of dill, leaves picked', 'STEP 1\r\nFirst, make the pickle. Mix all the ingredients together in a large bowl with 1 tsp flaky sea salt, then cover and set aside until needed.\r\n\r\nSTEP 2\r\nMix the couscous with 280ml boiling water in a bowl, cover and leave for 4 mins, then fluff up with a fork. Set aside to cool slightly.\r\n\r\nSTEP 3\r\nMeanwhile, drain and rinse the beans, tip into a bowl, then stir in the olive oil and chilli flakes along with a little seasoning.\r\n\r\nSTEP 4\r\nMix most of the dill through the couscous and season. To assemble, spoon the quick pickle, couscous, radishes, beans and cucumber into separate parts of each bowl. Top the pickle with the reserved dill and grind over some black pepper.'),
(9, 'Stir-fried Beef With Ginger', '350g lean beef, cut across the grain into thin slices (you need a quick-cooking cut, such as minute steak)\r\n1 lemongrass stalk, trimmed and finely chopped\r\n1 tbsp soy sauce\r\n2 tbsp fish sauce\r\n4 tsp brown sugar\r\n½ tsp chilli flakes\r\n1 lime, juiced\r\n3 tbsp vegetable oil\r\n1 green pepper, thinly sliced\r\n2 bunches of spring onions, green and white parts separated and finely sliced\r\n6 garlic cloves, finely chopped\r\n1 tbsp grated ginger\r\nsmall bunch of basil, or purple basil, leaves picked and roughly chopped\r\ncooked rice (about 250g uncooked weight), or cooked rice noodles\r\n50g roasted peanuts, roughly chopped', 'STEP 1\r\nToss the strips of steak, the lemongrass, soy sauce, half the fish sauce, half the sugar and half the chilli flakes together in a bowl. Set aside in the fridge to marinate for at least 20 mins or up to 6 hrs.\r\n\r\nSTEP 2\r\nMix the remaining fish sauce with the lime juice, remaining chilli flakes, the rest of the sugar and 3 tbsp water, then set aside.\r\n\r\nSTEP 3\r\nHeat 1 tbsp vegetable oil in a large non-stick or cast iron wok or frying pan over a high heat. Once hot, tip in half the marinated steak strips and stir-fry for 2 mins until just cooked through, then remove to a large plate using tongs or a slotted spoon and repeat using another 1 tbsp of oil and the remaining beef. Remove to the plate, then wipe the wok or pan clean using kitchen paper.\r\n\r\nSTEP 4\r\nAdd the remaining oil to the pan and fry the green pepper and the white parts of the spring onion. Stir-fry over a high heat for 2-3 mins, then add the garlic and ginger and stir-fry for another 45 seconds-1 min. Return the steak to the pan, stir well, then add the lime dressing and most of the basil leaves, mixing well to coat.\r\n\r\nSTEP 5\r\nDivide the stir-fry between bowls alongside rice or noodles, then scatter with the chopped peanuts, the remaining basil leaves and the green parts of the spring onions.'),
(10, 'Pork & Apple Burgers', '300g sausagemeat\r\n4 wholemeal burger buns\r\n4 tsp onion marmalade\r\n2 apples, cored and thinly sliced\r\n2 handfuls rocket\r\n2 tsp mayonnaise\r\na little English mustard (optional)\r\nsweet potato wedges, to serve (optional)', 'STEP 1\r\nDivide the sausagemeat into four portions and shape into patties. Fry in a non-stick pan for 10-12 mins, flipping a couple of times, until golden on both sides and cooked all the way through.\r\n\r\nSTEP 2\r\nHeat grill to high. Slice the buns in half and toast under the grill, cut-side up.\r\n\r\nSTEP 3\r\nSpread the bottom halves of the toasted buns with the marmalade, then add the burgers, apple slices, rocket, mayonnaise and mustard (if using). Top with the bun lids and serve alongside sweet potato wedges, if you like.');

-- --------------------------------------------------------

--
-- Table structure for table `llw_user`
--

CREATE TABLE `llw_user` (
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `pword` varchar(20) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_user`
--

INSERT INTO `llw_user` (`user_id`, `user`, `email_address`, `pword`, `user_type`) VALUES
(1, 'davebrown0398', 'dbrown41@qub.ac.uk', 'password', 'admin'),
(4, 'greg123', 'greg123@gmail.com', 'password', 'user'),
(5, 'bag123', 'bag123@gmail.com', 'password', 'user'),
(7, 'bigstu', 'stuartgirvine@icloud.com', 'Udchkajg3037!', 'user'),
(9, 'JackM', 'jack123@gmail.co.uk', 'jackm4321', 'user'),
(13, 'bro', 'eijjgt@gmail.com', 'bro', 'user'),
(27, 'dad', 'kfjfjfkd@gmai.com', 'dad', 'user'),
(28, 'mum', 'fjrerf@gmail.com', 'mum', 'user'),
(29, 'd', 'foffjer@gmirrj', 'd', 'user'),
(30, 'klfkld', 'fkskld@gmail.com', 'fdkojksd', 'user'),
(31, 'bean', 'fkfjkf@gmail.com', 'bean', 'user'),
(36, 'p', 'p@gmakf', 'p', 'user'),
(37, 'egg44', 'beans@gmail.com', 'egg', 'user'),
(38, 'b', 'greg123@gmail.con', 'b', 'user'),
(40, 'user1', 'user@gmail.com', 'user1', 'user'),
(41, 'user2', 'beans@gmail.com', 'user2', 'user'),
(47, 'kl', 'greg123@gmail.con', 'kl', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `llw_user_food`
--

CREATE TABLE `llw_user_food` (
  `user_food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_category_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `consumed` varchar(10) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_user_food`
--

INSERT INTO `llw_user_food` (`user_food_id`, `user_id`, `food_id`, `food_category_id`, `purchase_date`, `expiry_date`, `consumed`) VALUES
(179, 13, 1, 2, '2023-05-07', '2023-05-26', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `llw_wastage_fact`
--

CREATE TABLE `llw_wastage_fact` (
  `wastage_fact_id` int(11) NOT NULL,
  `wastage_fact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `llw_wastage_fact`
--

INSERT INTO `llw_wastage_fact` (`wastage_fact_id`, `wastage_fact`) VALUES
(1, 'Potatoes are the most wasted food in the UK, with 1.6 billion thrown away every year, according to WRAP.'),
(2, 'Roughly one-third of the food produced that is intended for human consumption every year- around 1.3 billion tons and valued at USD$1 trillion- is wasted or lost. This is enough to feed 3 billion people'),
(3, 'The water used to produce the food wasted could be used by 9 billion people at around 200 litres per person per day. The food currently wasted in Europe could feed 200 million people, in Latin America 300 million people, and in Africa 300 million people. '),
(4, 'Breaking it down by food group, losses, and waste per year are roughly 30% for cereals, 40-50% for root crops and fruit and vegetables, 20% for oil seed and meat and dairy, and 35% for fish. '),
(5, 'If 25% of the food currently being lost or wasted globally was saved, it would be enough to feed 870 million people around the world. '),
(6, 'By the mid-century, the world population will hit 9 billion people. By then, food production must be increased by 70% from today’s levels to meet this demand. '),
(7, 'Food losses translate into lost income for farmers and higher prices for consumers, giving us an economic incentive to reduce food waste. '),
(8, 'At the retail level, large quantities of food are wasted because of an emphasis on appearance half of all produce is thrown away in the US because it is deemed too “ugly” to eat; this amounts to 60 million tons of fruits and vegetables. '),
(9, 'An area larger than China and 25% of the world’s freshwater supply is used to grow food that is never eaten.'),
(10, 'Promotions in supermarkets may lead to more food waste; we may buy more food that we don’t necessarily need if we think we are getting more for our money. '),
(11, 'According to a survey conducted by Respect Food, 63% of people don’t know the difference between the “use by” and “best before” dates. Foods with “use by” dates are perishable and must be eaten before the given date. Foods with “best before” dates can be eaten after the given date, but they won’t be of the best quality. '),
(12, 'Because of quality standards that rely too much on appearance, crops are sometimes left unharvested and rot. \r\n\r\n'),
(13, 'In Europe, 40-60% of fish caught are discarded because they do not meet supermarket quality standards.'),
(14, 'In the UK the most thrown away food group in the country is fresh vegetables & salad, which makes up 28% of edible food waste.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `llw_admin`
--
ALTER TABLE `llw_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `llw_article`
--
ALTER TABLE `llw_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `llw_favourite_recipe`
--
ALTER TABLE `llw_favourite_recipe`
  ADD PRIMARY KEY (`favourite_recipe_id`),
  ADD KEY `FK_favourite_recipe_recipe` (`recipe_id`),
  ADD KEY `FK_favourite_recipe_user` (`user_id`);

--
-- Indexes for table `llw_food`
--
ALTER TABLE `llw_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `llw_food_category`
--
ALTER TABLE `llw_food_category`
  ADD PRIMARY KEY (`food_category_id`);

--
-- Indexes for table `llw_food_wasted`
--
ALTER TABLE `llw_food_wasted`
  ADD PRIMARY KEY (`food_wasted_id`),
  ADD KEY `FK_food_wasted_food_category` (`food_category_id`),
  ADD KEY `FK_food_wasted_user` (`user_id`),
  ADD KEY `FK_food_wasted_food` (`food_id`);

--
-- Indexes for table `llw_recipe`
--
ALTER TABLE `llw_recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `llw_user`
--
ALTER TABLE `llw_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `llw_user_food`
--
ALTER TABLE `llw_user_food`
  ADD PRIMARY KEY (`user_food_id`),
  ADD KEY `FK_user_food_user` (`user_id`),
  ADD KEY `FK_user_food_food_category` (`food_category_id`),
  ADD KEY `FK_user_food_food` (`food_id`);

--
-- Indexes for table `llw_wastage_fact`
--
ALTER TABLE `llw_wastage_fact`
  ADD PRIMARY KEY (`wastage_fact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `llw_admin`
--
ALTER TABLE `llw_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `llw_article`
--
ALTER TABLE `llw_article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `llw_favourite_recipe`
--
ALTER TABLE `llw_favourite_recipe`
  MODIFY `favourite_recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `llw_food`
--
ALTER TABLE `llw_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `llw_food_category`
--
ALTER TABLE `llw_food_category`
  MODIFY `food_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `llw_food_wasted`
--
ALTER TABLE `llw_food_wasted`
  MODIFY `food_wasted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `llw_recipe`
--
ALTER TABLE `llw_recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `llw_user`
--
ALTER TABLE `llw_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `llw_user_food`
--
ALTER TABLE `llw_user_food`
  MODIFY `user_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `llw_wastage_fact`
--
ALTER TABLE `llw_wastage_fact`
  MODIFY `wastage_fact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `llw_favourite_recipe`
--
ALTER TABLE `llw_favourite_recipe`
  ADD CONSTRAINT `FK_favourite_recipe_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `llw_recipe` (`recipe_id`),
  ADD CONSTRAINT `FK_favourite_recipe_user` FOREIGN KEY (`user_id`) REFERENCES `llw_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `llw_food_wasted`
--
ALTER TABLE `llw_food_wasted`
  ADD CONSTRAINT `FK_food_wasted_food` FOREIGN KEY (`food_id`) REFERENCES `llw_food` (`food_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_food_wasted_food_category` FOREIGN KEY (`food_category_id`) REFERENCES `llw_food_category` (`food_category_id`),
  ADD CONSTRAINT `FK_food_wasted_user` FOREIGN KEY (`user_id`) REFERENCES `llw_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `llw_user_food`
--
ALTER TABLE `llw_user_food`
  ADD CONSTRAINT `FK_user_food_food` FOREIGN KEY (`food_id`) REFERENCES `llw_food` (`food_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_user_food_food_category` FOREIGN KEY (`food_category_id`) REFERENCES `llw_food_category` (`food_category_id`),
  ADD CONSTRAINT `FK_user_food_user` FOREIGN KEY (`user_id`) REFERENCES `llw_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
