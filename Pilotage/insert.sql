SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;

TRUNCATE TABLE `buildings`;
TRUNCATE TABLE `technologies`;
TRUNCATE TABLE `modules`;

-- --------------------------------------------------------

INSERT INTO `buildings` (`bl_id`, `bl_name`, `bl_description`, `bl_buildingType`, `bl_picture`, `bl_cost1`, `bl_cost2`, `bl_cost3`, `bl_buildingTime`, `bl_costMultiplier`) VALUES
(1, 'Capitale de l''Empire', ' Vitrine de votre nation, la superficie de votre capitale détermine le taux de natalité de votre empire. ', 1, 'aucun.png', 550, 380, 0, 150, 2.00),
(2, ' Bureau des Régions', ' Le contrôle de l''extension de votre territoire vous permet de réguler votre taux de natalité. ', 1, 'habitation.png', 380, 290, 120, 300, 1.75),
(3, 'Mine de Titane', ' Matière première de votre planète, le titane doit être maintenu à un taux de rendement elevé. ', 2, 'aucun.png', 180, 90, 0, 15, 1.80),
(4, 'Mine de Béryl', ' Le béryl est un matériau proche du cristal utilisé fréquemment dans les technologies de pointes. ', 2, 'aucun.png', 240, 160, 10, 30, 1.80),
(5, ' Station d''extraction d''Hydrogène', ' Carburant écologique mais difficile à extraire, l''hydrogène doit être condensé avant son utilisation. ', 2, 'aucun.png', 380, 320, 0, 45, 1.80),
(6, 'Atelier de production', ' L''atelier vous permet de fabriquer différents types de modules, vous permettant d''assembler vos vaisseaux. ', 4, 'aucun.png', 1500, 750, 1000, 400, 1.70),
(7, 'Usine d''assemblage', ' C''est à l''usine que vous pourrez imaginer les plans de vos vaisseaux pour ensuite les assembler.\r\n ', 4, 'aucun.png', 1500, 500, 500, 450, 2.00),
(8, 'Entrepôts de Titane', 'Entrepôts de stockage de Titane, vous ne pouvez excéder sa capacité.\n<br />', 3, 'aucun.png', 1000, 0, 0, 100, 2.00),
(9, 'Entrepôts de Béryl', 'Entrepôts de stockage du Béryl, vous ne pouvez excéder sa capacité.\r\n<br />', 3, 'aucun.png', 1000, 500, 45, 150, 2.00),
(10, 'Silos à Hydrogène', 'Silos de stockage d''Hydrogène, vous ne pouvez excéder sa capacité.<br />', 3, 'aucun.png', 1500, 500, 210, 200, 2.00),
(11, 'Centre de recherche', ' La recherche de nouvelles technologies est essentielle pour l''évolution de votre empire. ', 4, 'aucun.png', 520, 600, 400, 120, 2.25);


-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

INSERT INTO `technologies` (`th_id`, `th_name`, `th_pitch`, `th_description`, `th_informations`) VALUES
(1, 'Énergie', '" Que ferions-nous sans énergie ? "', 'Ressource ultime de toute civilisation, l''amélioration de l''énergie vous permettra d''améliorer et de découvrir de nouvelles technologies.', ''),
(2, 'Production Minière', 'La technologie au service de l''homme !', 'Améliorer la vitesse de collecte des ressources vous octroi (pour chaque niveau d''amélioration) 5 % de production en plus sur toutes les ressources (or PR).', ''),
(3, 'Recherche Médicale', 'Pour une santé de fer !', 'La médecine permet à votre peuple de vivre dans de meilleures conditions. Chaque niveau d''amélioration augmente votre taux de natalité de 5 %.', 'Attention, ce bonus n''est plus pris en compte en cas de surpopulation !'),
(4, 'Contrôle des flottes', '" Toujours avoir l''avantage numérique "', 'L''évolution permanente de l''informatique dans l''empire vous permet de contrôler plus de flottes depuis votre centre de commande. Un niveau d''amélioration c''est un nouveau slot de flotte disponible !', ''),
(5, 'Ingénierie', 'Former pour détruire ?', 'La formation de jeunes ingénieurs ajouter à une technologique de pointe permet à tout empire digne de ce nom de posséder de plus gros vaisseau de guerre.', 'L''ingénierie vous permet d''obtenir des châssis de plus en plus évolués.'),
(6, 'Armement', '" Le nerf de la guerre se trouve ici, mon grand ... "', 'La recherche en armement vous permettra d''avoir l''avantage en puissance sur vos ennemis. Chaque niveau d''amélioration vous octroi 5 % de puissance en plus.', 'Améliorer cette technologie pour obtenir des modules d''armement plus évolués.'),
(7, 'Bouclier', '" ... mais également ici ! "', 'Qui n''a jamais rêvé d''une sécurité renforcée pour son vaisseau pour un poids minime ? Chaque niveau d''amélioration vous octroi 5 % de bouclier en plus.', 'Améliorer cette technologie pour obtenir des modules de boucliers plus évolués.'),
(8, 'Blindage', 'Il n''y a que cela qui te protège du vide de l''espace !', 'Le renforcement de la coque de chaque vaisseau est un processus long et coûteux, mais chaque niveau d''amélioration vous octroi 5 % de coque en plus.', 'Améliorer cette technologie pour obtenir de nouveau modules de coques !'),
(9, 'Propulsion', 'Plus vite que la lumière !', 'Plus un propulseur est puissant, plus votre vaisseau ira vite. Il faut également prendre en compte le poids des modules ce qui agace souvent de nombreux chercheurs !', 'Améliorer cette technologie pour obtenir des modules de propulsion plus évolués.');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------
-- Type des modules - 0: Châssis; 1: Propulsion; 2: Armement; 3: Bouclier; 4: Coque; 5: Stockage; 6: Supplémentaire
INSERT INTO `modules` (`mod_id`, `mod_name`, `mod_bonusType`, `mod_bonusValue`, `mod_baseTime`, `mod_cost1`, `mod_cost2`, `mod_cost3`) VALUES
(1, 'Châssis #01', 0, '12;2', 120, 1200, 200, 0), -- Chassis
(2, 'Châssis #02', 0, '15;3', 200, 1500, 300, 0),
(3, 'Châssis #03', 0, '18;3', 280, 1800, 300, 0),
(4, 'Châssis #04', 0, '20;4', 360, 2000, 400, 0),
(5, 'Châssis #05', 0, '25;4', 440, 2500, 400, 0),
(6, 'Châssis #06', 0, '32;5', 520, 3200, 500, 0),
(7, 'Châssis #07', 0, '40;6', 600, 4000, 1300, 0),
(8, 'Propulsion #01', 1, '4;10', 85, 400, 400, 1000), -- Propulsion
(9, 'Propulsion #02', 1, '6;13', 190, 600, 600, 1300),
(10, 'Propulsion #03', 1, '10;16', 300, 1000, 1000, 1600),
(11, 'Propulsion #04', 1, '15;20', 450, 1500, 1500, 2000),
(12, 'Armement #01', 2, '3;8', 75, 300, 150, 100), -- Armement
(13, 'Armement #02', 2, '5;10', 140, 500, 250, 175),
(14, 'Armement #03', 2, '9;14', 260, 900, 450, 300),
(15, 'Armement #04', 2, '15;19', 400, 1500, 750, 500),
(16, 'Bouclier #01', 3, '4;6', 120, 400, 800, 200), -- Bouclier
(17, 'Bouclier #02', 3, '8;9', 200, 800, 1600, 400),
(18, 'Bouclier #03', 3, '13;14', 300, 1300, 2600, 650),
(19, 'Coque #01', 4, '8;100', 90, 800, 0, 0), -- Coque
(20, 'Coque #02', 4, '13;300', 160, 1300, 0, 0),
(21, 'Stockage #01', 5, '2;3000', 60, 2000, 0, 0), -- Stockage
(22, 'Stockage #02', 5, '4;6000', 120, 4000, 0, 0),
(23, 'Stockage #03', 5, '7;12000', 240, 7000, 0, 0),
(24, 'Stockage #04', 5, '12;24000', 480, 12000, 0, 0),
(25, 'Camouflage', 6, '4;Camouflage', 750, 400, 1200, 2400), -- Other
(26, 'Hyperspace', 6, '8;Hyperspace', 600, 800, 800, 3200),
(27, 'Infanterie Légère', 7, '4;100', 90, 400, 200, 0), -- Ground Forces
(28, 'Infanterie Lourde', 7, '6;150', 180, 600, 300, 0),
(29, 'Blindé Léger', 7, '8;225', 60, 800, 400, 200),
(30, 'Blindé Lourd', 7, '11;350', 60, 1100, 550, 275);

SET FOREIGN_KEY_CHECKS=1;
