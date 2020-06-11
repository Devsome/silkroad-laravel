xSROMap.init('map');
// Add NPC's: [ { name , x , z , y , region, teleport : [ { name , x , z , y , region } , ... ] } , ...]
let NPCs = [{
    'name': 'Adventurer Demetri',
    'region': 26959,
    'x': 1354.66,
    'z': 80.0,
    'y': 580.23999,
    'teleport': []
}, {
    'name': 'Adventurer Flora',
    'region': 25000,
    'x': 1670.79,
    'z': 11.0,
    'y': 260.54001,
    'teleport': []
}, {
    'name': 'Aircraft Ticket Seller Ajati',
    'region': 24438,
    'x': 1120.72,
    'z': 2552.8101,
    'y': 313.19,
    'teleport': [{
        'name': 'Airship Ticket Seller Dawari',
        'region': 23929,
        'x': 862,
        'z': 2105,
        'y': 1623
    }, {
        'name': 'Airship Ticket Seller Poy',
        'region': 22137,
        'x': 1168,
        'z': 2030,
        'y': 824
    }, {'name': 'Aircraft Ticket Seller Saena', 'region': 25975, 'x': 1367, 'z': 296, 'y': 1626}]
}, {
    'name': 'Aircraft Ticket Seller Saena',
    'region': 25975,
    'x': 1368.73,
    'z': 324.81,
    'y': 1335.88,
    'teleport': [{
        'name': 'Aircraft Ticket Seller Ajati',
        'region': 24438,
        'x': 888,
        'z': 2523,
        'y': 538
    }, {'name': 'Airship Ticket Seller Dawari', 'region': 23929, 'x': 862, 'z': 2105, 'y': 1623}]
}, {
    'name': 'Aircraft Ticket Seller Sangnia',
    'region': 24424,
    'x': 1661.63,
    'z': 3892.8301,
    'y': 582.67999,
    'teleport': [{'name': 'Aircraft Ticket Seller Shard', 'region': 24934, 'x': 1279, 'z': 587, 'y': 92}]
}, {
    'name': 'Aircraft Ticket Seller Sayun',
    'region': 22134,
    'x': 919.96997,
    'z': 2545.55,
    'y': 1902.6,
    'teleport': [{
        'name': 'Airship Ticket Seller Dawari',
        'region': 23929,
        'x': 862,
        'z': 2105,
        'y': 1623
    }, {'name': 'Airship Ticket Seller Poy', 'region': 22137, 'x': 1168, 'z': 2030, 'y': 824}]
}, {
    'name': 'Aircraft Ticket Seller Shard',
    'region': 24934,
    'x': 1503.91,
    'z': 626.54999,
    'y': 70.900002,
    'teleport': [{'name': 'Aircraft Ticket Seller Sangnia', 'region': 24424, 'x': 1902, 'z': 3854, 'y': 657}]
}, {
    'name': 'Airship Ticket Seller Dawari',
    'region': 24185,
    'x': 615.53998,
    'z': 2134.74,
    'y': 27.1,
    'teleport': [{
        'name': 'Aircraft Ticket Seller Ajati',
        'region': 24438,
        'x': 888,
        'z': 2523,
        'y': 538
    }, {
        'name': 'Aircraft Ticket Seller Sayun',
        'region': 22390,
        'x': 909,
        'z': 2516,
        'y': 267
    }, {'name': 'Aircraft Ticket Seller Saena', 'region': 25975, 'x': 1367, 'z': 296, 'y': 1626}]
}, {
    'name': 'Airship Ticket Seller Poy',
    'region': 22137,
    'x': 851.51001,
    'z': 2064.4299,
    'y': 1033.4399,
    'teleport': [{
        'name': 'Aircraft Ticket Seller Ajati',
        'region': 24438,
        'x': 888,
        'z': 2523,
        'y': 538
    }, {'name': 'Aircraft Ticket Seller Sayun', 'region': 22390, 'x': 909, 'z': 2516, 'y': 267}]
}, {
    'name': 'Arena Item Manager',
    'region': 23687,
    'x': 1241.35,
    'z': 245.42999,
    'y': 469.28,
    'teleport': []
}, {
    'name': 'Arena Manager',
    'region': 25000,
    'x': 857.58002,
    'z': -32.580002,
    'y': 853.56,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Arena Manager',
    'region': 26265,
    'x': 932.44,
    'z': -106.76,
    'y': 1704.04,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Arena Manager',
    'region': 26959,
    'x': 431.73999,
    'z': 83.739998,
    'y': 892.15997,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Arena Manager',
    'region': 27500,
    'x': 346.60001,
    'z': 180.0,
    'y': 50.77,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Arena Manager',
    'region': 23088,
    'x': 780.54999,
    'z': 862.0,
    'y': 945.59003,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Arena Manager',
    'region': 23687,
    'x': 1242.4,
    'z': 245.95,
    'y': 507.35001,
    'teleport': [{'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }, {'name': 'Dungeon Manager', 'region': 27091, 'x': 800, 'z': 800, 'y': 950}, {
        'name': 'Dungeon Manager',
        'region': 27091,
        'x': 800,
        'z': 800,
        'y': 950
    }]
}, {
    'name': 'Armor Trader Sharon',
    'region': 23087,
    'x': 1731.92,
    'z': 863.31,
    'y': 875.04999,
    'teleport': []
}, {
    'name': 'Armor Trader Viviana',
    'region': 23602,
    'x': 639.19,
    'z': 1364.63,
    'y': 87.459999,
    'teleport': []
}, {
    'name': 'Association Boss Kapros',
    'region': 26702,
    'x': 1116.2,
    'z': 83.870003,
    'y': 1007.45,
    'teleport': []
}, {
    'name': 'Association Boss Uvetino',
    'region': 26702,
    'x': 591.77002,
    'z': 83.860001,
    'y': 479.32999,
    'teleport': []
}, {
    'name': 'Baal Deputy Leader Diva',
    'region': -32746,
    'x': 1233.5,
    'z': 1.59,
    'y': 756.14001,
    'teleport': []
}, {
    'name': 'Baal Worshipper Barun',
    'region': -32746,
    'x': -561.53998,
    'z': 1.11,
    'y': 385.38,
    'teleport': []
}, {
    'name': 'Baal Worshipper Cieta',
    'region': -32746,
    'x': -4.1399999,
    'z': 1.11,
    'y': -586.65997,
    'teleport': []
}, {
    'name': 'Baal Worshipper Maadu',
    'region': -32746,
    'x': 298.89999,
    'z': 1.11,
    'y': 214.12,
    'teleport': []
}, {
    'name': 'Baal Worshipper Million',
    'region': -32746,
    'x': 986.71002,
    'z': 1.11,
    'y': -2342.25,
    'teleport': []
}, {
    'name': 'Baal Worshipper Nana',
    'region': -32746,
    'x': 454.95001,
    'z': 1.11,
    'y': 280.51001,
    'teleport': []
}, {
    'name': 'Baal Worshipper Nimae',
    'region': -32746,
    'x': 491.62,
    'z': 1.11,
    'y': 325.94,
    'teleport': []
}, {
    'name': 'Baal Worshipper Raduma',
    'region': -32746,
    'x': -541.01001,
    'z': 1.11,
    'y': 312.01001,
    'teleport': []
}, {
    'name': 'Baal Worshipper Walter',
    'region': -32746,
    'x': -266.22,
    'z': 1.11,
    'y': 178.89999,
    'teleport': []
}, {
    'name': 'Baekako',
    'region': 26265,
    'x': 358.28,
    'z': -103.26,
    'y': 468.01001,
    'teleport': []
}, {
    'name': 'Bagger Sochil',
    'region': 24999,
    'x': 1386.09,
    'z': 16.74,
    'y': 543.72998,
    'teleport': []
}, {
    'name': 'Bandit Blacksmith',
    'region': 17487,
    'x': 257.14999,
    'z': 1381.16,
    'y': 1690.73,
    'teleport': []
}, {
    'name': 'Bandit Combat Assistant',
    'region': 17487,
    'x': 452.53,
    'z': 1381.09,
    'y': 1724.6801,
    'teleport': []
}, {
    'name': 'Bandit Fortress Administrator',
    'region': 17487,
    'x': 557.71002,
    'z': 1381.08,
    'y': 1723.99,
    'teleport': []
}, {
    'name': 'Berenice',
    'region': -32752,
    'x': 7592.0098,
    'z': 111.56,
    'y': 55.549999,
    'teleport': []
}, {
    'name': 'Black Robber Band',
    'region': 24758,
    'x': 1247.88,
    'z': -27.549999,
    'y': 1073.61,
    'teleport': []
}, {
    'name': 'Blacksmith Agol',
    'region': 26265,
    'x': 1197.6899,
    'z': -106.67,
    'y': 1217.7,
    'teleport': []
}, {
    'name': 'Blacksmith Chulsan',
    'region': 25000,
    'x': 332.73001,
    'z': 0.0,
    'y': 1406.7,
    'teleport': []
}, {
    'name': 'Blacksmith Soboi',
    'region': 23687,
    'x': 501.57999,
    'z': 243.58,
    'y': 766.27002,
    'teleport': []
}, {
    'name': 'Boat Ticket Seller Ahgon',
    'region': 23432,
    'x': 950.03998,
    'z': 13.65,
    'y': 1270.3101,
    'teleport': []
}, {
    'name': 'Boat Ticket Seller Asa',
    'region': 23183,
    'x': 275.92001,
    'z': -25.639999,
    'y': 888.48999,
    'teleport': [{'name': 'Boat Ticket Seller Asimo', 'region': 23180, 'x': 1413, 'z': -37, 'y': 769}]
}, {
    'name': 'Boat Ticket Seller Asimo',
    'region': 23180,
    'x': 1644.16,
    'z': -32.060001,
    'y': 752.78998,
    'teleport': [{'name': 'Boat Ticket Seller Asa', 'region': 23183, 'x': 464, 'z': -57, 'y': 879}]
}, {
    'name': 'Boat Ticket Seller Rahan',
    'region': 23436,
    'x': 1189.4,
    'z': -22.49,
    'y': 1324.5699,
    'teleport': [{'name': 'Boat Ticket Seller Salmai', 'region': 23439, 'x': 583, 'z': -22, 'y': 1858}]
}, {
    'name': 'Boat Ticket Seller Salmai',
    'region': 23439,
    'x': 323.35999,
    'z': 17.889999,
    'y': 1747.85,
    'teleport': [{'name': 'Boat Ticket Seller Rahan', 'region': 23436, 'x': 904, 'z': -23, 'y': 1412}]
}, {
    'name': 'Boy Yongso',
    'region': 27728,
    'x': 1681.53,
    'z': 742.08002,
    'y': 1483.9,
    'teleport': []
}, {
    'name': 'Buddhist Priest Bupgong',
    'region': 26521,
    'x': 637.73999,
    'z': -96.25,
    'y': 1489.99,
    'teleport': []
}, {
    'name': 'Buddhist Priest Fa',
    'region': 26521,
    'x': 937.28998,
    'z': -93.949997,
    'y': 1791.27,
    'teleport': []
}, {
    'name': 'Buddhist Priest Hyeon',
    'region': 26521,
    'x': 1402.05,
    'z': -79.75,
    'y': 1258.65,
    'teleport': []
}, {
    'name': 'Buddhist Priest Jeonghye',
    'region': 25257,
    'x': 659.73999,
    'z': 0.0,
    'y': 981.13,
    'teleport': []
}, {
    'name': 'Buddhist Priest Kushyan',
    'region': 25257,
    'x': 692.15997,
    'z': -0.02,
    'y': 137.35001,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 26265,
    'x': 961.96002,
    'z': -106.76,
    'y': 1569.27,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 23088,
    'x': 437.60001,
    'z': 862.0,
    'y': 1258.38,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 27243,
    'x': 1842.03,
    'z': 180.0,
    'y': 1662.1899,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 22106,
    'x': 1389.48,
    'z': -420.28,
    'y': 1488.4,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 25000,
    'x': 1101.47,
    'z': -32.09,
    'y': 884.19,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 26959,
    'x': 815.28003,
    'z': 83.739998,
    'y': 1150.3,
    'teleport': []
}, {
    'name': 'Carnival Manager Jooa',
    'region': 23687,
    'x': 1159.13,
    'z': 244.06,
    'y': 370.25,
    'teleport': []
}, {
    'name': 'Casino Guardian Huhoan',
    'region': 25001,
    'x': 509.22,
    'z': -64.830002,
    'y': 755.23999,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 17990,
    'x': 353.53,
    'z': 40.0,
    'y': 597.38,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 17488,
    'x': 428.17001,
    'z': 1377.62,
    'y': 254.09,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 17735,
    'x': 370.66,
    'z': 0.0,
    'y': 420.91,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 17230,
    'x': 803.98999,
    'z': 1385.22,
    'y': 1801.6899,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15431,
    'x': 1065.03,
    'z': 12.28,
    'y': 248.14,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15174,
    'x': 901.65997,
    'z': 11.72,
    'y': 534.92999,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15429,
    'x': 1224.97,
    'z': 11.66,
    'y': 695.96997,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15708,
    'x': 1708.97,
    'z': 0.0,
    'y': 1420.7,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15709,
    'x': 250.55,
    'z': 0.0,
    'y': 1497.63,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 15966,
    'x': 217.86,
    'z': 0.0,
    'y': 1557.59,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 17736,
    'x': 1520.12,
    'z': 39.990002,
    'y': 1514.85,
    'teleport': []
}, {
    'name': 'Castle Gate Pulley',
    'region': 16222,
    'x': 180.64999,
    'z': 0.0,
    'y': 84.059998,
    'teleport': []
}, {
    'name': 'Challenge Box',
    'region': -32762,
    'x': 18101.07,
    'z': -47.240002,
    'y': -32.639999,
    'teleport': []
}, {
    'name': 'China Goods Supplier Ye-Ryeong',
    'region': 25000,
    'x': 1230.96,
    'z': -33.09,
    'y': 1119.78,
    'teleport': []
}, {
    'name': 'China Medicine Supplier Dae-Pyeong',
    'region': 26265,
    'x': 818.46002,
    'z': -106.77,
    'y': 1749.24,
    'teleport': []
}, {
    'name': 'China Medicine Supplier Dae-Pyeong',
    'region': 25000,
    'x': 1214.74,
    'z': -33.169998,
    'y': 1138.78,
    'teleport': []
}, {
    'name': 'China Medicine Supplier Dae-Pyeong',
    'region': 23687,
    'x': 1678.6,
    'z': 255.45,
    'y': 386.95001,
    'teleport': []
}, {
    'name': 'China Valuables Dealer Ryoe-A',
    'region': 25000,
    'x': 1248.85,
    'z': -33.0,
    'y': 1102.79,
    'teleport': []
}, {
    'name': 'China Valuables Dealer Ryoe-Ju',
    'region': 23687,
    'x': 1805.97,
    'z': 254.17,
    'y': 134.58,
    'teleport': []
}, {
    'name': 'China Valuables Dealer Ryoe-Won',
    'region': 26265,
    'x': 766.34003,
    'z': -106.77,
    'y': 1809.24,
    'teleport': []
}, {
    'name': 'Clergy Gabriel',
    'region': 27216,
    'x': 1734.83,
    'z': 283.73999,
    'y': 880.71002,
    'teleport': []
}, {
    'name': 'Consignment Merchant Juel',
    'region': 26959,
    'x': 17.18,
    'z': 80.440002,
    'y': 258.14999,
    'teleport': []
}, {
    'name': 'Consignment Merchant Juel',
    'region': 23687,
    'x': 1490.73,
    'z': 243.99001,
    'y': 968.19,
    'teleport': []
}, {
    'name': 'Consignment Merchant Juel',
    'region': 25000,
    'x': 1760.45,
    'z': 11.0,
    'y': 419.17001,
    'teleport': []
}, {
    'name': 'Consul Rialto',
    'region': 27214,
    'x': 807.88,
    'z': 98.190002,
    'y': 994.69,
    'teleport': []
}, {
    'name': 'Courage Box',
    'region': -32762,
    'x': 18102.699,
    'z': -47.240002,
    'y': 5588.8501,
    'teleport': []
}, {
    'name': 'Daily Quest Manager Asshur',
    'region': 26959,
    'x': 897.96002,
    'z': 83.739998,
    'y': 721.15997,
    'teleport': []
}, {
    'name': 'Daily Quest Manager Bai Man',
    'region': 26265,
    'x': 1138.34,
    'z': -106.74,
    'y': 1775.12,
    'teleport': []
}, {
    'name': 'Daily Quest Manager Dasra',
    'region': 23687,
    'x': 1674.91,
    'z': 248.42,
    'y': 559.34003,
    'teleport': []
}, {
    'name': 'Daily Quest Manager Senlaf',
    'region': 27500,
    'x': 239.17999,
    'z': 180.0,
    'y': 339.64001,
    'teleport': []
}, {
    'name': 'Daily Quest Manager Wei Yan',
    'region': 25000,
    'x': 716.98999,
    'z': -33.169998,
    'y': 1107.1899,
    'teleport': []
}, {
    'name': 'Demon Shaitan Morphstone',
    'region': 27091,
    'x': 1142.97,
    'z': 382.01001,
    'y': 1127.4301,
    'teleport': []
}, {
    'name': 'Demon Shaitan Morphstone',
    'region': 27091,
    'x': 1142.23,
    'z': 381.66,
    'y': 1127.04,
    'teleport': []
}, {
    'name': 'Doctor Mentuhotep',
    'region': -32752,
    'x': 7636.0801,
    'z': 111.56,
    'y': 74.610001,
    'teleport': []
}, {
    'name': 'Doctor Renenutet',
    'region': 22831,
    'x': 1716.37,
    'z': 949.82001,
    'y': 1903.42,
    'teleport': []
}, {
    'name': 'Donwhang Goods Supplier Ye-Rang',
    'region': 26265,
    'x': 786.70001,
    'z': -106.77,
    'y': 1776.36,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8799,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8301,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.2,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28663,
    'x': 1899.23,
    'z': -981.0,
    'y': 1261.78,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8198,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.1,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28663,
    'x': 1899.23,
    'z': -981.0,
    'y': 1261.76,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28663,
    'x': 1899.23,
    'z': -982.0,
    'y': 1261.77,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 29427,
    'x': 183.05,
    'z': -781.0,
    'y': 1578.79,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 29427,
    'x': 183.05,
    'z': -780.0,
    'y': 1578.77,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 29427,
    'x': 183.05,
    'z': -780.0,
    'y': 1578.78,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28644,
    'x': 1484.15,
    'z': -257.0,
    'y': 1664.58,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8101,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28663,
    'x': 1899.23,
    'z': -981.0,
    'y': 1261.75,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.6,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28644,
    'x': 1484.15,
    'z': -257.0,
    'y': 1670.58,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8701,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 29427,
    'x': 183.05,
    'z': -780.0,
    'y': 1578.76,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.7,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.5,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28644,
    'x': 1484.15,
    'z': -257.0,
    'y': 1670.55,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32751,
    'x': 1134.79,
    'z': 0.0,
    'y': -864.28998,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8599,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 32484,
    'x': 896.23999,
    'z': 692.15997,
    'y': 1122.54,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 28644,
    'x': 1484.15,
    'z': -257.0,
    'y': 1670.5601,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.4,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.0,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8501,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': -705.59003,
    'z': 143.81,
    'y': 1233.3,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': 31459,
    'x': 395.92999,
    'z': 792.46997,
    'y': 1775.33,
    'teleport': []
}, {
    'name': 'Dungeon Exit',
    'region': -32750,
    'x': 10751.49,
    'z': 165.72,
    'y': -6106.8398,
    'teleport': []
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.33002,
    'z': 628.71002,
    'y': 1108.61,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.42999,
    'z': 628.64001,
    'y': 1108.46,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.66998,
    'z': 628.81,
    'y': 1108.28,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.33002,
    'z': 628.66998,
    'y': 1108.21,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.98999,
    'z': 628.25,
    'y': 1107.9399,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.41998,
    'z': 628.0,
    'y': 1108.9301,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.15002,
    'z': 628.0,
    'y': 1108.13,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Dungeon Manager',
    'region': 27091,
    'x': 779.17999,
    'z': 628.23999,
    'y': 1108.41,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}]
}, {
    'name': 'Eastern Europe Blacksmith',
    'region': 15709,
    'x': 800.64001,
    'z': 0.0,
    'y': 1888.6,
    'teleport': []
}, {
    'name': 'Eastern Europe Combat Assistant',
    'region': 15709,
    'x': 541.40002,
    'z': 0.0,
    'y': 1902.3,
    'teleport': []
}, {
    'name': 'Eastern Europe Fortress Administrator',
    'region': 15709,
    'x': 410.73001,
    'z': 0.0,
    'y': 1901.24,
    'teleport': []
}, {
    'name': 'Eastern Europe Fortress Clerk',
    'region': 27214,
    'x': 1663.4399,
    'z': 80.0,
    'y': 1050.1899,
    'teleport': []
}, {
    'name': 'Eastern Europe Trainer',
    'region': 15709,
    'x': 685.77002,
    'z': 0.0,
    'y': 1886.49,
    'teleport': []
}, {
    'name': 'Egyptian Sailor 1',
    'region': 24112,
    'x': 1455.1801,
    'z': 535.78003,
    'y': 155.39999,
    'teleport': []
}, {
    'name': 'Egyptian Sailor 1',
    'region': 24111,
    'x': 1858.0601,
    'z': 537.40997,
    'y': 236.42999,
    'teleport': []
}, {
    'name': 'Egyptian Sailor 2',
    'region': 24112,
    'x': 1689.52,
    'z': 519.32001,
    'y': 157.02,
    'teleport': []
}, {
    'name': 'Egyptian Sailor 2',
    'region': 24111,
    'x': 1470.21,
    'z': 545.0,
    'y': 563.01001,
    'teleport': []
}, {
    'name': 'Egyptian Sailor 2',
    'region': 23857,
    'x': 704.78998,
    'z': 551.90002,
    'y': 544.53998,
    'teleport': []
}, {
    'name': 'Egyptian Soldier Aptaru',
    'region': 23603,
    'x': 1326.97,
    'z': 1559.98,
    'y': 759.94,
    'teleport': []
}, {
    'name': 'Egyptian Soldier Kamori',
    'region': 23603,
    'x': 1179.79,
    'z': 1559.48,
    'y': 989.85999,
    'teleport': []
}, {
    'name': 'Egyptian Soldier Mobefe',
    'region': 22833,
    'x': 667.65002,
    'z': 790.72998,
    'y': 1199.3199,
    'teleport': []
}, {
    'name': 'Egyptian Soldier Turian',
    'region': 22833,
    'x': 471.22,
    'z': 791.89001,
    'y': 1001.9,
    'teleport': []
}, {
    'name': 'Europe Goods Supplier Ohara',
    'region': 26959,
    'x': 486.95999,
    'z': 83.129997,
    'y': 1042.9301,
    'teleport': []
}, {
    'name': 'Europe Medicine Supplier Shadi',
    'region': 27499,
    'x': 1616.26,
    'z': 180.0,
    'y': 223.77,
    'teleport': []
}, {
    'name': 'Europe Medicine Supplier Shadi',
    'region': 23687,
    'x': 1678.66,
    'z': 262.85001,
    'y': 336.59,
    'teleport': []
}, {
    'name': 'Europe Medicine Supplier Shadi',
    'region': 26959,
    'x': 504.87,
    'z': 83.730003,
    'y': 1086.59,
    'teleport': []
}, {
    'name': 'Europe Valuables Dealer David',
    'region': 23687,
    'x': 1776.04,
    'z': 253.99001,
    'y': 162.97,
    'teleport': []
}, {
    'name': 'Europe Valuables Dealer Sid',
    'region': 27499,
    'x': 1654.5601,
    'z': 180.0,
    'y': 311.48999,
    'teleport': []
}, {
    'name': 'Europe Valuables Dealer Zephyd',
    'region': 26959,
    'x': 465.91,
    'z': 83.269997,
    'y': 1015.56,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 23088,
    'x': 449.84,
    'z': 862.0,
    'y': 1269.51,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 26959,
    'x': 843.84998,
    'z': 83.739998,
    'y': 1138.0,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 25000,
    'x': 1101.6801,
    'z': -32.279999,
    'y': 854.29999,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 23687,
    'x': 1130.4,
    'z': 245.02,
    'y': 370.64001,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 26265,
    'x': 932.34003,
    'z': -106.76,
    'y': 1569.58,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 22106,
    'x': 1499.51,
    'z': -432.39001,
    'y': 1425.5699,
    'teleport': []
}, {
    'name': 'Event So-Ok',
    'region': 27244,
    'x': 52.139999,
    'z': 180.0,
    'y': 1681.3199,
    'teleport': []
}, {
    'name': 'Exorcist Miaoryeong',
    'region': 25253,
    'x': 142.88,
    'z': 225.84,
    'y': 822.10999,
    'teleport': []
}, {
    'name': 'Expeditionary Force Commander Pakrun',
    'region': 22101,
    'x': 322.76001,
    'z': 0.0,
    'y': 928.84998,
    'teleport': []
}, {
    'name': 'Expeditionary Soldier Alamatun',
    'region': 22101,
    'x': 317.95999,
    'z': 0.0,
    'y': 990.62,
    'teleport': []
}, {
    'name': 'Expeditionary Soldier Muhibun',
    'region': 22101,
    'x': 375.60999,
    'z': 0.0,
    'y': 901.40002,
    'teleport': []
}, {
    'name': 'Farm Keeper Jyamilrun',
    'region': 22869,
    'x': 1851.5601,
    'z': 0.0,
    'y': 1262.84,
    'teleport': []
}, {
    'name': 'Farm Owner Mujariun',
    'region': 22357,
    'x': 1914.89,
    'z': -0.19,
    'y': 1286.52,
    'teleport': []
}, {
    'name': 'Farmer Wife Hadijya',
    'region': 22357,
    'x': 1802.25,
    'z': -5.0000001E-2,
    'y': 1243.5,
    'teleport': []
}, {
    'name': 'Ferry Ticket Seller Chau',
    'region': 24734,
    'x': 330.34,
    'z': 61.889999,
    'y': 1606.66,
    'teleport': [{'name': 'Ferry Ticket Seller Hageuk', 'region': 25244, 'x': 1025, 'z': 160, 'y': 601}]
}, {
    'name': 'Ferry Ticket Seller Doji',
    'region': 24993,
    'x': 362.29999,
    'z': 72.480003,
    'y': 1761.33,
    'teleport': [{'name': 'Ferry Ticket Seller Tayun', 'region': 25761, 'x': 636, 'z': 160, 'y': 1482}]
}, {
    'name': 'Ferry Ticket Seller Hageuk',
    'region': 25244,
    'x': 919.71997,
    'z': 69.370003,
    'y': 366.88,
    'teleport': [{'name': 'Ferry Ticket Seller Chau', 'region': 24734, 'x': 523, 'z': 140, 'y': 1267}]
}, {
    'name': 'Ferry Ticket Seller Tayun',
    'region': 25761,
    'x': 513.15997,
    'z': 89.610001,
    'y': 1281.35,
    'teleport': [{'name': 'Ferry Ticket Seller Doji', 'region': 24993, 'x': 560, 'z': 140, 'y': 1460}]
}, {
    'name': 'Finance Officer Maneto',
    'region': 23345,
    'x': 650.95001,
    'z': 1401.0,
    'y': 1166.71,
    'teleport': []
}, {
    'name': 'Fruit Trader Syukri',
    'region': 22361,
    'x': 721.41998,
    'z': -432.13,
    'y': 449.79999,
    'teleport': []
}, {
    'name': 'General Ratchel',
    'region': 26702,
    'x': 1140.54,
    'z': 83.870003,
    'y': 1638.6899,
    'teleport': []
}, {
    'name': 'General Sonhyeon',
    'region': 25255,
    'x': 588.04999,
    'z': 0.0,
    'y': 299.92001,
    'teleport': []
}, {
    'name': 'Gisaeng Ahjin',
    'region': 24999,
    'x': 793.90997,
    'z': -3.45,
    'y': 1033.92,
    'teleport': []
}, {
    'name': 'Gisaeng Ahjin',
    'region': 29899,
    'x': 355.70001,
    'z': -126.07,
    'y': 389.12,
    'teleport': []
}, {
    'name': 'Gisaeng Juju',
    'region': 24999,
    'x': 1405.36,
    'z': 0.70999998,
    'y': 1192.83,
    'teleport': []
}, {
    'name': 'Gisaeng Juyeong',
    'region': 24999,
    'x': 1500.02,
    'z': 0.0,
    'y': 966.16998,
    'teleport': []
}, {
    'name': 'Gisaeng Mihyang',
    'region': 24999,
    'x': 772.72998,
    'z': -2.1199999,
    'y': 1045.6899,
    'teleport': []
}, {
    'name': 'Gisaeng So-Ok',
    'region': 24999,
    'x': 901.51001,
    'z': 16.190001,
    'y': 621.17999,
    'teleport': []
}, {
    'name': 'Gisaeng Yumi',
    'region': 24999,
    'x': 647.53003,
    'z': 15.92,
    'y': 367.54999,
    'teleport': []
}, {
    'name': 'Governor Senmute',
    'region': 23343,
    'x': 1344.36,
    'z': 978.45001,
    'y': 377.82001,
    'teleport': []
}, {
    'name': 'Grocery Trader Bajel',
    'region': 26959,
    'x': 699.15002,
    'z': 80.0,
    'y': 253.89,
    'teleport': []
}, {
    'name': 'Grocery Trader Jinjin',
    'region': 25000,
    'x': 1658.55,
    'z': 0.0,
    'y': 1078.1899,
    'teleport': []
}, {
    'name': 'Grocery Trader Kapra',
    'region': 23602,
    'x': 1225.1801,
    'z': 1447.88,
    'y': 529.21997,
    'teleport': []
}, {
    'name': 'Grocery Trader Melit',
    'region': 23088,
    'x': 1245.35,
    'z': 863.35999,
    'y': 1053.9399,
    'teleport': []
}, {
    'name': 'Grocery Trader Saha',
    'region': 27243,
    'x': 1644.8101,
    'z': 180.0,
    'y': 1460.36,
    'teleport': []
}, {
    'name': 'Grocery Trader Warda',
    'region': 22617,
    'x': 1027.54,
    'z': -431.29999,
    'y': 950.45001,
    'teleport': []
}, {
    'name': 'Grocery Trader Yeosun',
    'region': 26265,
    'x': 559.19,
    'z': -104.28,
    'y': 737.88,
    'teleport': []
}, {
    'name': 'Guard Abdul Ali',
    'region': 22106,
    'x': 1688.71,
    'z': -432.39001,
    'y': 555.44,
    'teleport': []
}, {
    'name': 'Guard Aziz',
    'region': 22617,
    'x': 1807.1,
    'z': -432.54999,
    'y': 339.92001,
    'teleport': []
}, {
    'name': 'Guard Bari',
    'region': 22617,
    'x': 1809.47,
    'z': -432.64001,
    'y': 241.67999,
    'teleport': []
}, {
    'name': 'Guard Basit',
    'region': 22617,
    'x': 244.49001,
    'z': -432.29999,
    'y': 542.97998,
    'teleport': []
}, {
    'name': 'Guard Djabal',
    'region': 22106,
    'x': 1509.24,
    'z': -432.44,
    'y': 559.64001,
    'teleport': []
}, {
    'name': 'Guard Djaman',
    'region': 22620,
    'x': 280.5,
    'z': -430.5,
    'y': 618.32001,
    'teleport': []
}, {
    'name': 'Guard Duban',
    'region': 22875,
    'x': 1609.0699,
    'z': -430.5,
    'y': 131.96001,
    'teleport': []
}, {
    'name': 'Guard Hajib',
    'region': 22874,
    'x': 1337.86,
    'z': -430.73001,
    'y': 49.790001,
    'teleport': []
}, {
    'name': 'Guard Harun',
    'region': 22362,
    'x': 1673.96,
    'z': -433.28,
    'y': 373.56,
    'teleport': []
}, {
    'name': 'Guard Hindshind',
    'region': 22362,
    'x': 1551.83,
    'z': -433.28,
    'y': 375.42999,
    'teleport': []
}, {
    'name': 'Guard Imanun',
    'region': 22364,
    'x': 449.17001,
    'z': -430.5,
    'y': 1422.4399,
    'teleport': []
}, {
    'name': 'Guard Jaffar',
    'region': 22875,
    'x': 1642.12,
    'z': -430.5,
    'y': 13.14,
    'teleport': []
}, {
    'name': 'Guard Ka\'ish',
    'region': 22620,
    'x': 253.83,
    'z': -430.5,
    'y': 741.02002,
    'teleport': []
}, {
    'name': 'Guard Kaupun',
    'region': 22364,
    'x': 447.19,
    'z': -430.48999,
    'y': 1237.0601,
    'teleport': []
}, {
    'name': 'Guard Moharet',
    'region': 22874,
    'x': 1505.63,
    'z': -430.60999,
    'y': 50.84,
    'teleport': []
}, {
    'name': 'Guard Mutaqa Quatun',
    'region': 22619,
    'x': 1704.58,
    'z': -430.5,
    'y': 391.85001,
    'teleport': []
}, {
    'name': 'Guard Mutaqa Trissun',
    'region': 22619,
    'x': 1705.3101,
    'z': -430.5,
    'y': 499.67001,
    'teleport': []
}, {
    'name': 'Guard Patah',
    'region': 22617,
    'x': 243.66,
    'z': -432.01001,
    'y': 316.62,
    'teleport': []
}, {
    'name': 'Guide Lipria',
    'region': 27471,
    'x': 1349.25,
    'z': 82.699997,
    'y': 412.72,
    'teleport': [{'name': 'Guide Riise', 'region': 26959, 'x': 542, 'z': 83, 'y': 1147}, {
        'name': 'Guide Raffy',
        'region': 26957,
        'x': 1609,
        'z': 80,
        'y': 1381
    }]
}, {
    'name': 'Guide Raffy',
    'region': 26957,
    'x': 1650.2,
    'z': 83.870003,
    'y': 1332.48,
    'teleport': [{'name': 'Guide Lipria', 'region': 27471, 'x': 1321, 'z': 82, 'y': 422}, {
        'name': 'Guide Riise',
        'region': 26959,
        'x': 542,
        'z': 83,
        'y': 1147
    }]
}, {
    'name': 'Guide Riise',
    'region': 26959,
    'x': 562.85999,
    'z': 83.629997,
    'y': 1138.58,
    'teleport': [{'name': 'Guide Lipria', 'region': 27471, 'x': 1321, 'z': 82, 'y': 422}, {
        'name': 'Guide Raffy',
        'region': 26957,
        'x': 1609,
        'z': 80,
        'y': 1381
    }]
}, {
    'name': 'Guild Manager Elia',
    'region': 23347,
    'x': 194.28,
    'z': 1402.9,
    'y': 1447.84,
    'teleport': []
}, {
    'name': 'Guild Manager Gilt',
    'region': 26704,
    'x': 77.739998,
    'z': -143.96001,
    'y': 250.19,
    'teleport': []
}, {
    'name': 'Guild Manager Hapsa',
    'region': 27500,
    'x': 138.78999,
    'z': 180.0,
    'y': 910.38,
    'teleport': []
}, {
    'name': 'Guild Manager Leebaek',
    'region': 25255,
    'x': 1027.0,
    'z': 0.0,
    'y': 569.78998,
    'teleport': []
}, {
    'name': 'Guild Manager Musai',
    'region': 24199,
    'x': 1145.5601,
    'z': 267.67001,
    'y': 585.75,
    'teleport': []
}, {
    'name': 'Guild Manager Nuur',
    'region': 22107,
    'x': 25.6,
    'z': -433.28,
    'y': 1728.99,
    'teleport': []
}, {
    'name': 'Guild Manager Ryukang',
    'region': 26265,
    'x': 1354.42,
    'z': -104.74,
    'y': 448.95001,
    'teleport': []
}, {
    'name': 'Guild Manager Sennefer',
    'region': 23344,
    'x': 643.77002,
    'z': 930.0,
    'y': 1471.98,
    'teleport': []
}, {
    'name': 'Harbor Manager Gale',
    'region': 25163,
    'x': 958.04999,
    'z': -155.03999,
    'y': 98.970001,
    'teleport': [{
        'name': 'Pirate Morgun',
        'region': 26457,
        'x': 1254,
        'z': -9,
        'y': 1114
    }, {'name': 'Priate Blackbeard', 'region': 25945, 'x': 1246, 'z': -5, 'y': 1210}, {
        'name': 'Harbor Manager Marwa',
        'region': 23856,
        'x': 1525,
        'z': 585,
        'y': 1688
    }]
}, {
    'name': 'Harbor Manager Georion',
    'region': 26960,
    'x': 1522.87,
    'z': -27.59,
    'y': 67.400002,
    'teleport': []
}, {
    'name': 'Harbor Manager Marwa',
    'region': 23856,
    'x': 1623.1801,
    'z': 584.91998,
    'y': 1794.8,
    'teleport': [{
        'name': 'Pirate Morgun',
        'region': 26457,
        'x': 1254,
        'z': -9,
        'y': 1114
    }, {'name': 'Priate Blackbeard', 'region': 25945, 'x': 1246, 'z': -5, 'y': 1210}, {
        'name': 'Harbor Manager Gale',
        'region': 25163,
        'x': 734,
        'z': -184,
        'y': 168
    }]
}, {
    'name': 'Herbalist Bori',
    'region': 26265,
    'x': 597.25,
    'z': -106.46,
    'y': 1134.97,
    'teleport': []
}, {
    'name': 'Herbalist Yangyun',
    'region': 25000,
    'x': 1584.08,
    'z': 0.0,
    'y': 1407.29,
    'teleport': []
}, {
    'name': 'Hero Box',
    'region': -32762,
    'x': -18150.801,
    'z': -47.240002,
    'y': -5824.6401,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 25000,
    'x': 895.5,
    'z': -29.17,
    'y': 758.59998,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 23088,
    'x': 856.26001,
    'z': 863.35999,
    'y': 1074.41,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 27244,
    'x': 123.49,
    'z': 180.0,
    'y': 1678.22,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 23687,
    'x': 1218.64,
    'z': 243.44,
    'y': 420.95001,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 26959,
    'x': 821.44,
    'z': 83.739998,
    'y': 645.06,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 22106,
    'x': 1315.84,
    'z': -433.28,
    'y': 1491.88,
    'teleport': []
}, {
    'name': 'Homeless Genie',
    'region': 26265,
    'x': 877.78998,
    'z': -106.77,
    'y': 1528.75,
    'teleport': []
}, {
    'name': 'Honmusa',
    'region': 26265,
    'x': 457.67001,
    'z': -103.37,
    'y': 468.51999,
    'teleport': []
}, {
    'name': 'Hotan Blacksmith',
    'region': 14917,
    'x': 906.71002,
    'z': 84.620003,
    'y': 1859.38,
    'teleport': []
}, {
    'name': 'Hotan Combat Assistant',
    'region': 15173,
    'x': 591.48999,
    'z': 84.199997,
    'y': 70.360001,
    'teleport': []
}, {
    'name': 'Hotan Fortress Administrator',
    'region': 15173,
    'x': 679.09998,
    'z': 84.970001,
    'y': 165.75999,
    'teleport': []
}, {
    'name': 'Hotan Fortress Clerk',
    'region': 24199,
    'x': 154.38,
    'z': 151.53,
    'y': 811.03998,
    'teleport': []
}, {
    'name': 'Hotan Goods Supplier Sarha',
    'region': 23687,
    'x': 1643.55,
    'z': 243.81,
    'y': 166.11,
    'teleport': []
}, {
    'name': 'Hotan Trainer',
    'region': 14917,
    'x': 814.44,
    'z': 84.620003,
    'y': 1768.6899,
    'teleport': []
}, {
    'name': 'Hunter Associate Adria',
    'region': 27214,
    'x': 1091.91,
    'z': 79.989998,
    'y': 154.23,
    'teleport': []
}, {
    'name': 'Hunter Associate Ahmok',
    'region': 23688,
    'x': 328.88,
    'z': 20.0,
    'y': 1553.96,
    'teleport': []
}, {
    'name': 'Hunter Associate Gwakwi',
    'region': 25255,
    'x': 1600.3101,
    'z': 0.0,
    'y': 400.38,
    'teleport': []
}, {
    'name': 'Hunter Associate Haraho',
    'region': 26521,
    'x': 599.57001,
    'z': -106.25,
    'y': 637.78998,
    'teleport': []
}, {
    'name': 'Hunter Associate Shahad',
    'region': 27500,
    'x': 405.87,
    'z': 180.0,
    'y': 1282.9301,
    'teleport': []
}, {
    'name': 'Hunter Association Head Sami',
    'region': 22874,
    'x': 841.98999,
    'z': -430.70999,
    'y': 565.71997,
    'teleport': []
}, {
    'name': 'Hunter Union  Representative Kapado',
    'region': -32752,
    'x': -4026.71,
    'z': 70.519997,
    'y': -3190.73,
    'teleport': []
}, {
    'name': 'Hunter Union Item Exchange manager Bakara',
    'region': 23344,
    'x': 1137.4399,
    'z': 936.0,
    'y': 1608.41,
    'teleport': []
}, {
    'name': 'Hunter Union President Narmer',
    'region': 23344,
    'x': 792.20001,
    'z': 930.0,
    'y': 979.31,
    'teleport': []
}, {
    'name': 'Imhotep Morphstone',
    'region': 27091,
    'x': 1142.3199,
    'z': 381.60999,
    'y': 810.84003,
    'teleport': []
}, {
    'name': 'Imhotep Morphstone',
    'region': 27091,
    'x': 1142.42,
    'z': 381.0,
    'y': 810.39001,
    'teleport': []
}, {
    'name': 'Inn Master Sikeulro',
    'region': 26959,
    'x': 1348.9,
    'z': 80.0,
    'y': 845.88,
    'teleport': []
}, {
    'name': 'Islam Merchant Ishyak',
    'region': 25000,
    'x': 1670.6801,
    'z': 11.0,
    'y': 580.81,
    'teleport': []
}, {
    'name': 'Jangan Blacksmith',
    'region': 17990,
    'x': 615.79999,
    'z': 40.0,
    'y': 1083.84,
    'teleport': []
}, {
    'name': 'Jangan Combat Assistant',
    'region': 17990,
    'x': 1404.92,
    'z': 69.0,
    'y': 1324.96,
    'teleport': []
}, {
    'name': 'Jangan Fortress Administrator',
    'region': 17990,
    'x': 890.13,
    'z': 67.0,
    'y': 1337.29,
    'teleport': []
}, {
    'name': 'Jangan Fortress Clerk',
    'region': 25256,
    'x': 1569.34,
    'z': 69.82,
    'y': 1115.21,
    'teleport': []
}, {
    'name': 'Jangan Trainer',
    'region': 17990,
    'x': 1142.27,
    'z': 40.0,
    'y': 1158.45,
    'teleport': []
}, {
    'name': 'Jewel Lapidary Mamoje',
    'region': 23431,
    'x': 859.33002,
    'z': 243.81,
    'y': 1874.0601,
    'teleport': []
}, {
    'name': 'Job Union Representative Mansuana',
    'region': -32752,
    'x': 6353.9302,
    'z': 69.849998,
    'y': -19.65,
    'teleport': []
}, {'name': 'Juho', 'region': 25255, 'x': 1491.36, 'z': 40.0, 'y': 1520.0699, 'teleport': []}, {
    'name': 'King Shahryar',
    'region': 22618,
    'x': 1317.95,
    'z': -236.59,
    'y': 274.88,
    'teleport': []
}, {
    'name': 'Librarian Ahha',
    'region': 23345,
    'x': 809.51001,
    'z': 1401.0,
    'y': 1081.63,
    'teleport': []
}, {
    'name': 'Lighthouse Keeper Snefru',
    'region': 24112,
    'x': 286.72,
    'z': 584.73999,
    'y': 470.60999,
    'teleport': []
}, {
    'name': 'Lost Commander Dustun',
    'region': -32746,
    'x': -225.36,
    'z': 1.59,
    'y': -1572.11,
    'teleport': []
}, {
    'name': 'Lost Investigator Almanu',
    'region': 31980,
    'x': 715.97998,
    'z': 1116.0,
    'y': 297.01001,
    'teleport': []
}, {
    'name': 'Lost Investigator Avrill',
    'region': 23498,
    'x': 168.14999,
    'z': -204.59,
    'y': 1724.6,
    'teleport': []
}, {
    'name': 'Lost Investigator Captain Aaliyah',
    'region': 32237,
    'x': 147.0,
    'z': 856.0,
    'y': 1082.6801,
    'teleport': []
}, {
    'name': 'Lost Investigator Elda',
    'region': 31723,
    'x': 1440.9301,
    'z': 856.0,
    'y': 555.91998,
    'teleport': []
}, {
    'name': 'Lost Investigator Kristen',
    'region': 32236,
    'x': 91.699997,
    'z': 856.0,
    'y': 1084.41,
    'teleport': []
}, {
    'name': 'Lost Investigator Natal',
    'region': 32236,
    'x': 945.04999,
    'z': 886.03998,
    'y': 840.79999,
    'teleport': []
}, {
    'name': 'Lost Investigator Rachel',
    'region': 31981,
    'x': 517.08002,
    'z': 896.53998,
    'y': 520.38,
    'teleport': []
}, {
    'name': 'Lost Investigator Ruin',
    'region': 31979,
    'x': 1272.27,
    'z': 896.29999,
    'y': 527.52002,
    'teleport': []
}, {
    'name': 'Lost Soldier Bolt',
    'region': -32746,
    'x': 2.47,
    'z': 1.11,
    'y': -653.84003,
    'teleport': []
}, {
    'name': 'Lost Soldier Brandon',
    'region': 23498,
    'x': 279.39001,
    'z': -206.0,
    'y': 1758.8199,
    'teleport': []
}, {
    'name': 'Lost Soldier Charles',
    'region': 32236,
    'x': 945.54999,
    'z': 854.19,
    'y': 662.79999,
    'teleport': []
}, {
    'name': 'Lost Soldier Chrom',
    'region': 23498,
    'x': 258.06,
    'z': -210.14999,
    'y': 1829.55,
    'teleport': []
}, {
    'name': 'Lost Soldier Ciel',
    'region': 31980,
    'x': 984.23999,
    'z': 999.19,
    'y': 743.88,
    'teleport': []
}, {
    'name': 'Lost Soldier Fernando',
    'region': -32746,
    'x': -22.66,
    'z': 1.11,
    'y': -323.98999,
    'teleport': []
}, {
    'name': 'Lost Soldier Geese',
    'region': 32237,
    'x': 135.66,
    'z': 856.0,
    'y': 1071.45,
    'teleport': []
}, {
    'name': 'Lost Soldier Gote',
    'region': 32236,
    'x': 87.529999,
    'z': 856.0,
    'y': 1089.3101,
    'teleport': []
}, {
    'name': 'Lost Soldier Jyss',
    'region': 31724,
    'x': 433.37,
    'z': 1115.29,
    'y': 745.15997,
    'teleport': []
}, {
    'name': 'Lost Soldier Kaal',
    'region': 31980,
    'x': 827.28003,
    'z': 992.0,
    'y': 753.28003,
    'teleport': []
}, {
    'name': 'Lost Soldier Leon',
    'region': 31980,
    'x': 901.03998,
    'z': 950.0,
    'y': 804.17999,
    'teleport': []
}, {
    'name': 'Lost Soldier Nell',
    'region': 31980,
    'x': 1026.89,
    'z': 1067.0,
    'y': 683.56,
    'teleport': []
}, {
    'name': 'Lost Soldier Neon',
    'region': -32746,
    'x': 1238.27,
    'z': 1.59,
    'y': 846.35999,
    'teleport': []
}, {
    'name': 'Lost Soldier Nice',
    'region': 31980,
    'x': 751.98999,
    'z': 992.0,
    'y': 738.79999,
    'teleport': []
}, {
    'name': 'Lost Soldier Rice',
    'region': 31980,
    'x': 801.28003,
    'z': 1115.52,
    'y': 534.92999,
    'teleport': []
}, {
    'name': 'Lost Soldier Rion',
    'region': 31980,
    'x': 1114.6801,
    'z': 992.72998,
    'y': 734.65002,
    'teleport': []
}, {
    'name': 'Lost Soldier Rubel',
    'region': 31980,
    'x': 760.78998,
    'z': 1038.0,
    'y': 691.97998,
    'teleport': []
}, {
    'name': 'Lost Soldier Will',
    'region': 22219,
    'x': 696.31,
    'z': 475.63,
    'y': 1749.22,
    'teleport': []
}, {
    'name': 'Lottery Seller Wangwon',
    'region': 25001,
    'x': 225.84,
    'z': -35.98,
    'y': 911.37,
    'teleport': []
}, {'name': 'Magic POP', 'region': 25000, 'x': 1612.97, 'z': 0.0, 'y': 1193.0, 'teleport': []}, {
    'name': 'Magic POP',
    'region': 23088,
    'x': 1364.37,
    'z': 863.35999,
    'y': 1130.77,
    'teleport': []
}, {
    'name': 'Magic POP',
    'region': 23687,
    'x': 1652.38,
    'z': 243.82001,
    'y': 776.57001,
    'teleport': []
}, {
    'name': 'Magic POP',
    'region': 26959,
    'x': 444.23999,
    'z': 80.32,
    'y': 225.94,
    'teleport': []
}, {
    'name': 'Magic POP',
    'region': 22106,
    'x': 1696.21,
    'z': -433.28,
    'y': 1379.62,
    'teleport': []
}, {
    'name': 'Magic POP',
    'region': 26265,
    'x': 543.90997,
    'z': -106.74,
    'y': 1533.36,
    'teleport': []
}, {
    'name': 'Magic POP',
    'region': 27244,
    'x': 913.69,
    'z': 180.0,
    'y': 1828.76,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 23088,
    'x': 786.20001,
    'z': 863.35999,
    'y': 1262.53,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 27244,
    'x': 586.65002,
    'z': 180.0,
    'y': 1414.74,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 22106,
    'x': 1704.5699,
    'z': -432.39001,
    'y': 1421.5,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 23687,
    'x': 1002.84,
    'z': 243.98,
    'y': 489.59,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 25000,
    'x': 977.28003,
    'z': -32.619999,
    'y': 727.63,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 26959,
    'x': 979.03998,
    'z': 83.739998,
    'y': 888.53998,
    'teleport': []
}, {
    'name': 'Magic POP Guide Gori',
    'region': 26265,
    'x': 1162.7,
    'z': -106.7,
    'y': 1385.8101,
    'teleport': []
}, {
    'name': 'Medic Footco',
    'region': 23498,
    'x': 151.64999,
    'z': -209.27,
    'y': 1791.8,
    'teleport': []
}, {
    'name': 'Merchant Associate Asaman',
    'region': 23687,
    'x': 1574.02,
    'z': 243.81,
    'y': 840.15997,
    'teleport': []
}, {
    'name': 'Merchant Associate Hwajung',
    'region': 25000,
    'x': 1760.84,
    'z': 11.0,
    'y': 357.51001,
    'teleport': []
}, {
    'name': 'Merchant Associate Karen',
    'region': 27244,
    'x': 669.69,
    'z': 180.0,
    'y': 1823.29,
    'teleport': []
}, {
    'name': 'Merchant Associate Leegeuk',
    'region': 26265,
    'x': 446.66,
    'z': -106.68,
    'y': 1560.8199,
    'teleport': []
}, {
    'name': 'Merchant Associate Tana',
    'region': 26959,
    'x': 165.07001,
    'z': 85.489998,
    'y': 173.33,
    'teleport': []
}, {
    'name': 'Merchant Association Head Hassan',
    'region': 22617,
    'x': 1525.9399,
    'z': -432.38,
    'y': 79.93,
    'teleport': []
}, {
    'name': 'Minister Abshad',
    'region': 22363,
    'x': 1175.9399,
    'z': -393.92001,
    'y': 103.84,
    'teleport': []
}, {
    'name': 'Minister Mahmud',
    'region': 22363,
    'x': 1611.5601,
    'z': -412.73999,
    'y': 532.56,
    'teleport': []
}, {
    'name': 'Mysterious Device',
    'region': 21838,
    'x': 97.540001,
    'z': -73.93,
    'y': 1429.34,
    'teleport': []
}, {
    'name': 'Mysterious Device',
    'region': 22094,
    'x': 1745.87,
    'z': 74.120003,
    'y': 1531.4,
    'teleport': []
}, {
    'name': 'Mysterious Device',
    'region': 22607,
    'x': 693.19,
    'z': -2.3299999,
    'y': 173.64999,
    'teleport': []
}, {
    'name': 'Mysterious Device',
    'region': 22864,
    'x': 302.45999,
    'z': -3.9200001,
    'y': 456.23999,
    'teleport': []
}, {
    'name': 'Mysterious Priest',
    'region': 23687,
    'x': 1062.16,
    'z': 295.23999,
    'y': 582.65997,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 26959,
    'x': 706.01001,
    'z': 107.74,
    'y': 1146.55,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 23088,
    'x': 541.39001,
    'z': 863.35999,
    'y': 880.56,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 22106,
    'x': 1691.29,
    'z': -433.28,
    'y': 1628.78,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 26265,
    'x': 1059.13,
    'z': -106.75,
    'y': 1712.05,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 25000,
    'x': 1068.62,
    'z': -0.38999999,
    'y': 953.67999,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Mysterious Priest',
    'region': 27244,
    'x': 285.29001,
    'z': 180.0,
    'y': 1846.4,
    'teleport': [{'name': 'Sealed Dungeon of Vicious Shadows', 'region': -32742, 'x': 958, 'z': -134, 'y': 1213}]
}, {
    'name': 'Nephrite Refiner Pahap',
    'region': 24200,
    'x': 375.39001,
    'z': -16.18,
    'y': 659.09998,
    'teleport': []
}, {
    'name': 'Nephthys Morphstone',
    'region': 27091,
    'x': 1142.42,
    'z': 381.76999,
    'y': 1127.8,
    'teleport': []
}, {
    'name': 'Nephthys Morphstone',
    'region': 27091,
    'x': 1142.0601,
    'z': 381.0,
    'y': 1127.21,
    'teleport': []
}, {
    'name': 'Niya Shaman Morphstone',
    'region': 27091,
    'x': 1141.88,
    'z': 381.85999,
    'y': 1127.92,
    'teleport': []
}, {
    'name': 'Niya Shaman Morphstone',
    'region': 27091,
    'x': 1142.13,
    'z': 381.53,
    'y': 1127.47,
    'teleport': []
}, {
    'name': 'Nun Martel',
    'region': 27243,
    'x': 1426.0699,
    'z': 180.0,
    'y': 1851.0,
    'teleport': []
}, {
    'name': 'Nun Retaldi',
    'region': 26959,
    'x': 1338.79,
    'z': 84.089996,
    'y': 1400.89,
    'teleport': []
}, {
    'name': 'Oil Merchant Khaled',
    'region': 22361,
    'x': 454.79999,
    'z': -432.26001,
    'y': 1242.6,
    'teleport': []
}, {
    'name': 'Outpost Commander Albert',
    'region': 27983,
    'x': 164.94,
    'z': 163.16,
    'y': 1065.35,
    'teleport': []
}, {
    'name': 'Outpost Commander Amanda',
    'region': 27717,
    'x': 1118.86,
    'z': -114.83,
    'y': 1479.39,
    'teleport': []
}, {
    'name': 'Outpost Commander Austin',
    'region': 26977,
    'x': 769.15002,
    'z': 179.99001,
    'y': 648.62,
    'teleport': []
}, {
    'name': 'Outpost Commander Bai Qi Long',
    'region': 26267,
    'x': 1090.22,
    'z': -97.360001,
    'y': 1328.2,
    'teleport': []
}, {
    'name': 'Outpost Commander Dao Zhi Fong',
    'region': 26260,
    'x': 504.73001,
    'z': 30.18,
    'y': 1880.8,
    'teleport': []
}, {
    'name': 'Outpost Commander Dick',
    'region': 25930,
    'x': 1109.08,
    'z': -6.0700002,
    'y': 1078.67,
    'teleport': []
}, {
    'name': 'Outpost Commander Ethan',
    'region': 26229,
    'x': 541.33002,
    'z': 195.53,
    'y': 1706.77,
    'teleport': []
}, {
    'name': 'Outpost Commander Galia',
    'region': 26202,
    'x': 1608.95,
    'z': 2.8099999,
    'y': 1814.64,
    'teleport': []
}, {
    'name': 'Outpost Commander Gavin',
    'region': 26478,
    'x': 160.10001,
    'z': 181.41,
    'y': 552.89001,
    'teleport': []
}, {
    'name': 'Outpost Commander Guo Mu Hu',
    'region': 25244,
    'x': 394.95001,
    'z': 72.370003,
    'y': 1659.3199,
    'teleport': []
}, {
    'name': 'Outpost Commander Hao Hung',
    'region': 23435,
    'x': 1368.36,
    'z': 12.07,
    'y': 1264.38,
    'teleport': []
}, {
    'name': 'Outpost Commander Haviel',
    'region': 25956,
    'x': 597.41998,
    'z': 180.0,
    'y': 338.47,
    'teleport': []
}, {
    'name': 'Outpost Commander Hu Ru Lang',
    'region': 23682,
    'x': 1656.71,
    'z': 610.32001,
    'y': 1559.6801,
    'teleport': []
}, {
    'name': 'Outpost Commander Mu Qi Yong',
    'region': 22653,
    'x': 317.57001,
    'z': 857.5,
    'y': 734.58002,
    'teleport': []
}, {
    'name': 'Outpost Commander Mu Ri Lun',
    'region': 24469,
    'x': 1128.05,
    'z': 62.130001,
    'y': 1719.7,
    'teleport': []
}, {
    'name': 'Outpost Commander Raman',
    'region': 25491,
    'x': 1719.86,
    'z': 38.849998,
    'y': 657.54999,
    'teleport': []
}, {
    'name': 'Outpost Commander Ru Long Hu',
    'region': 25223,
    'x': 1309.21,
    'z': 115.4,
    'y': 1752.95,
    'teleport': []
}, {
    'name': 'Outpost Commander Tan Wei',
    'region': 24221,
    'x': 158.61,
    'z': 394.45001,
    'y': 532.54999,
    'teleport': []
}, {
    'name': 'Outpost Commander Tsai Bao',
    'region': 23972,
    'x': 978.53003,
    'z': 559.77002,
    'y': 597.53003,
    'teleport': []
}, {
    'name': 'Outpost Commander Wang Pai',
    'region': 24490,
    'x': 613.01001,
    'z': 26.469999,
    'y': 524.17999,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Aoman',
    'region': 23435,
    'x': 1340.98,
    'z': 16.440001,
    'y': 1216.36,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Baba',
    'region': 26478,
    'x': 212.31,
    'z': 178.92,
    'y': 521.02002,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Chao Leung',
    'region': 22653,
    'x': 251.02,
    'z': 861.64001,
    'y': 734.28998,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Cindy',
    'region': 27983,
    'x': 106.27,
    'z': 164.25,
    'y': 1064.77,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Daniel',
    'region': 27717,
    'x': 1084.3199,
    'z': -96.650002,
    'y': 1426.36,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Doris',
    'region': 26229,
    'x': 589.13,
    'z': 192.17,
    'y': 1709.84,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Edan',
    'region': 25491,
    'x': 1688.52,
    'z': 41.209999,
    'y': 590.69,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Fa Wu',
    'region': 25244,
    'x': 407.32001,
    'z': 75.800003,
    'y': 1607.75,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Fu Jiu Lan',
    'region': 23972,
    'x': 981.37,
    'z': 568.90002,
    'y': 543.84003,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Han Bi',
    'region': 24469,
    'x': 1119.38,
    'z': 30.93,
    'y': 1771.77,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Mahap',
    'region': 25223,
    'x': 1307.11,
    'z': 114.38,
    'y': 1694.67,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Rachel',
    'region': 25930,
    'x': 1148.62,
    'z': -3.96,
    'y': 1104.5,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Shadi',
    'region': 26202,
    'x': 1604.0601,
    'z': 0.0,
    'y': 1761.22,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Shan Qing',
    'region': 24221,
    'x': 135.75,
    'z': 394.89001,
    'y': 468.95999,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Shima',
    'region': 23682,
    'x': 1607.51,
    'z': 615.04999,
    'y': 1560.54,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Vanessa',
    'region': 26977,
    'x': 813.65002,
    'z': 180.0,
    'y': 618.22998,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Xiao Hu',
    'region': 26260,
    'x': 487.22,
    'z': 43.490002,
    'y': 1819.12,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Xiao Jun',
    'region': 26267,
    'x': 1131.4,
    'z': -99.809998,
    'y': 1363.0699,
    'teleport': []
}, {
    'name': 'Outpost Deputy Commander Zhi Dao',
    'region': 24490,
    'x': 665.90002,
    'z': 23.709999,
    'y': 528.77002,
    'teleport': []
}, {
    'name': 'Outpost Guard Anet',
    'region': 26202,
    'x': 1630.45,
    'z': 0.0,
    'y': 1736.63,
    'teleport': []
}, {
    'name': 'Outpost Guard Asoho',
    'region': 24469,
    'x': 1135.27,
    'z': 24.709999,
    'y': 1798.21,
    'teleport': []
}, {
    'name': 'Outpost Guard Augustin',
    'region': 25930,
    'x': 1166.35,
    'z': -0.70999998,
    'y': 1139.9,
    'teleport': []
}, {
    'name': 'Outpost Guard Bob',
    'region': 27983,
    'x': 82.879997,
    'z': 147.25,
    'y': 1037.59,
    'teleport': []
}, {
    'name': 'Outpost Guard Caleb',
    'region': 26229,
    'x': 613.15002,
    'z': 198.00999,
    'y': 1735.59,
    'teleport': []
}, {
    'name': 'Outpost Guard Chahamma',
    'region': 23682,
    'x': 1579.78,
    'z': 611.66998,
    'y': 1535.88,
    'teleport': []
}, {
    'name': 'Outpost Guard Chase',
    'region': 25930,
    'x': 1069.75,
    'z': -1.42,
    'y': 1074.29,
    'teleport': []
}, {
    'name': 'Outpost Guard Chi Hu Dai',
    'region': 22653,
    'x': 352.20001,
    'z': 857.53003,
    'y': 710.83002,
    'teleport': []
}, {
    'name': 'Outpost Guard Dan Xie',
    'region': 23972,
    'x': 1027.49,
    'z': 546.78003,
    'y': 635.12,
    'teleport': []
}, {
    'name': 'Outpost Guard Dao Hu',
    'region': 25244,
    'x': 445.07999,
    'z': 71.970001,
    'y': 1579.85,
    'teleport': []
}, {
    'name': 'Outpost Guard Dao Lian Hong',
    'region': 25491,
    'x': 1653.87,
    'z': 40.09,
    'y': 589.15997,
    'teleport': []
}, {
    'name': 'Outpost Guard Dave',
    'region': 27983,
    'x': 203.89999,
    'z': 146.71001,
    'y': 1034.04,
    'teleport': []
}, {
    'name': 'Outpost Guard De Allo',
    'region': 25956,
    'x': 564.83002,
    'z': 180.0,
    'y': 308.75,
    'teleport': []
}, {
    'name': 'Outpost Guard Dexter',
    'region': 26478,
    'x': 115.7,
    'z': 177.24001,
    'y': 548.78003,
    'teleport': []
}, {
    'name': 'Outpost Guard Duadi',
    'region': 26202,
    'x': 1634.14,
    'z': 2.1800001,
    'y': 1833.45,
    'teleport': []
}, {
    'name': 'Outpost Guard Hadaz',
    'region': 23435,
    'x': 1401.21,
    'z': 16.790001,
    'y': 1265.0601,
    'teleport': []
}, {
    'name': 'Outpost Guard He Zhi Hu',
    'region': 25244,
    'x': 412.35999,
    'z': 70.07,
    'y': 1699.95,
    'teleport': []
}, {
    'name': 'Outpost Guard Hu Ma Long',
    'region': 23682,
    'x': 1690.66,
    'z': 610.59998,
    'y': 1526.84,
    'teleport': []
}, {
    'name': 'Outpost Guard Iz',
    'region': 24490,
    'x': 704.78998,
    'z': 20.27,
    'y': 489.07001,
    'teleport': []
}, {
    'name': 'Outpost Guard Ji He Long',
    'region': 26260,
    'x': 509.62,
    'z': 30.77,
    'y': 1782.1801,
    'teleport': []
}, {
    'name': 'Outpost Guard Juana',
    'region': 26977,
    'x': 751.77002,
    'z': 179.67999,
    'y': 708.28998,
    'teleport': []
}, {
    'name': 'Outpost Guard Liao Xiao Jun',
    'region': 26267,
    'x': 1039.01,
    'z': -88.809998,
    'y': 1313.71,
    'teleport': []
}, {
    'name': 'Outpost Guard Ma Lian Hong',
    'region': 24469,
    'x': 1170.37,
    'z': 97.889999,
    'y': 1692.6,
    'teleport': []
}, {
    'name': 'Outpost Guard Marcel',
    'region': 27717,
    'x': 1160.5699,
    'z': -134.97,
    'y': 1492.37,
    'teleport': []
}, {
    'name': 'Outpost Guard Qin Jia Qong',
    'region': 23972,
    'x': 1027.34,
    'z': 566.09998,
    'y': 499.87,
    'teleport': []
}, {
    'name': 'Outpost Guard Rabbath',
    'region': 25223,
    'x': 1337.53,
    'z': 113.29,
    'y': 1790.42,
    'teleport': []
}, {
    'name': 'Outpost Guard Racus',
    'region': 26977,
    'x': 866.82001,
    'z': 179.94,
    'y': 629.08002,
    'teleport': []
}, {
    'name': 'Outpost Guard Ramadin',
    'region': 25491,
    'x': 1704.95,
    'z': 42.330002,
    'y': 687.95001,
    'teleport': []
}, {
    'name': 'Outpost Guard Ramina',
    'region': 25956,
    'x': 650.15002,
    'z': 180.0,
    'y': 345.17999,
    'teleport': []
}, {
    'name': 'Outpost Guard Ru Li Mao',
    'region': 26260,
    'x': 535.62,
    'z': 38.619999,
    'y': 1892.99,
    'teleport': []
}, {
    'name': 'Outpost Guard Sao Ma',
    'region': 25223,
    'x': 1343.8,
    'z': 114.32,
    'y': 1657.85,
    'teleport': []
}, {
    'name': 'Outpost Guard Shaha',
    'region': 22653,
    'x': 227.39999,
    'z': 864.0,
    'y': 708.69,
    'teleport': []
}, {
    'name': 'Outpost Guard Shao Mu Dai',
    'region': 26267,
    'x': 1138.86,
    'z': -88.779999,
    'y': 1420.0699,
    'teleport': []
}, {
    'name': 'Outpost Guard Wei Mao',
    'region': 24221,
    'x': 129.61,
    'z': 406.5,
    'y': 571.57001,
    'teleport': []
}, {
    'name': 'Outpost Guard Wei Yen',
    'region': 24490,
    'x': 582.14001,
    'z': 21.17,
    'y': 487.13,
    'teleport': []
}, {
    'name': 'Outpost Guard Yang Shang Li',
    'region': 24221,
    'x': 93.139999,
    'z': 404.54999,
    'y': 447.64001,
    'teleport': []
}, {
    'name': 'Outpost Guard Yang Yen',
    'region': 23435,
    'x': 1361.3101,
    'z': 26.23,
    'y': 1170.89,
    'teleport': []
}, {
    'name': 'Outpost Volunteer Gemma',
    'region': 25956,
    'x': 555.23999,
    'z': 180.0,
    'y': 261.78,
    'teleport': []
}, {
    'name': 'Outpost Volunteer Lily',
    'region': 27717,
    'x': 1094.8,
    'z': -81.720001,
    'y': 1389.1801,
    'teleport': []
}, {
    'name': 'Outpost Volunteer Masha',
    'region': 26229,
    'x': 506.82999,
    'z': 194.62,
    'y': 1732.54,
    'teleport': []
}, {
    'name': 'Outpost Volunteer Roxy',
    'region': 26478,
    'x': 222.10001,
    'z': 174.11,
    'y': 472.39999,
    'teleport': []
}, {
    'name': 'Palace Guard Alim',
    'region': 22618,
    'x': 1072.66,
    'z': -236.59,
    'y': 391.14999,
    'teleport': []
}, {
    'name': 'Palace Guard Azim',
    'region': 22362,
    'x': 1317.03,
    'z': -236.59,
    'y': 1854.29,
    'teleport': []
}, {
    'name': 'Palace Guard Mushari',
    'region': 23343,
    'x': 1440.9399,
    'z': 963.12,
    'y': 174.46001,
    'teleport': []
}, {
    'name': 'Palace Guard Sesilrum',
    'region': 23343,
    'x': 1546.88,
    'z': 963.0,
    'y': 281.07999,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8301,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8101,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.47,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8198,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8799,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3701,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1699,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3301,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.41,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1099,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8201,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.48,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3201,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28657,
    'x': 1771.6801,
    'z': -870.0,
    'y': 1231.4,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1802,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3799,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1602,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 29427,
    'x': 330.04999,
    'z': -780.0,
    'y': 1412.03,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 27636,
    'x': 1273.95,
    'z': -850.0,
    'y': 283.06,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8401,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 29427,
    'x': 330.04999,
    'z': -781.0,
    'y': 1412.04,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8799,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8501,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28644,
    'x': 1414.29,
    'z': -255.0,
    'y': 1575.16,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.42,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8398,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1499,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3601,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8601,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.4301,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28657,
    'x': 1771.6801,
    'z': -871.0,
    'y': 1231.5,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8501,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3501,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8701,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.4399,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8599,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1299,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3401,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28920,
    'x': 786.23999,
    'z': -891.0,
    'y': 155.85001,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 27636,
    'x': 1273.95,
    'z': -851.0,
    'y': 283.03,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8899,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.45,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -3780.97,
    'z': 78.559998,
    'y': -7943.8701,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28920,
    'x': 786.23999,
    'z': -890.0,
    'y': 155.84,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1201,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7537.9902,
    'z': 78.510002,
    'y': -1848.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 10894.34,
    'z': 159.52,
    'y': -6258.1401,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28644,
    'x': 1414.29,
    'z': -255.0,
    'y': 1575.15,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': 2033.92,
    'z': 78.510002,
    'y': -3925.3899,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31715,
    'x': 295.25,
    'z': 790.47998,
    'y': 447.28,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 32484,
    'x': 1196.37,
    'z': 700.25,
    'y': 975.59998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 29427,
    'x': 330.04999,
    'z': -780.0,
    'y': 1412.05,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28647,
    'x': 1860.7,
    'z': -220.0,
    'y': 1262.0699,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28647,
    'x': 1860.7,
    'z': -220.0,
    'y': 1262.04,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28640,
    'x': 478.26001,
    'z': -120.0,
    'y': 650.97998,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28644,
    'x': 1414.29,
    'z': -255.0,
    'y': 1575.13,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28640,
    'x': 478.26001,
    'z': -120.0,
    'y': 650.95001,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28640,
    'x': 478.26001,
    'z': -120.0,
    'y': 650.96997,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28647,
    'x': 1860.7,
    'z': -220.0,
    'y': 1262.0601,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31972,
    'x': 453.45001,
    'z': 765.87,
    'y': 1741.91,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28657,
    'x': 1771.6801,
    'z': -870.0,
    'y': 1231.7,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28644,
    'x': 1414.29,
    'z': -255.0,
    'y': 1575.14,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 27636,
    'x': 1273.95,
    'z': -850.0,
    'y': 283.04999,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': -32750,
    'x': -7107.79,
    'z': 161.58,
    'y': 3290.8301,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 29427,
    'x': 330.04999,
    'z': -780.0,
    'y': 1412.0601,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28657,
    'x': 1771.6801,
    'z': -870.0,
    'y': 1231.6,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28640,
    'x': 478.26001,
    'z': -120.0,
    'y': 650.96002,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28920,
    'x': 786.23999,
    'z': -890.0,
    'y': 155.86,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28647,
    'x': 1860.7,
    'z': -220.0,
    'y': 1262.05,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 27636,
    'x': 1273.95,
    'z': -850.0,
    'y': 283.04001,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 28920,
    'x': 786.23999,
    'z': -890.0,
    'y': 155.87,
    'teleport': []
}, {
    'name': 'Pillar of Party Member Recall',
    'region': 31717,
    'x': 1153.0699,
    'z': 647.35999,
    'y': 1763.46,
    'teleport': []
}, {
    'name': 'Pirate Morgun',
    'region': 26457,
    'x': 1330.52,
    'z': 26.27,
    'y': 908.75,
    'teleport': [{
        'name': 'Harbor Manager Gale',
        'region': 25163,
        'x': 734,
        'z': -184,
        'y': 168
    }, {'name': 'Harbor Manager Marwa', 'region': 23856, 'x': 1525, 'z': 585, 'y': 1688}]
}, {
    'name': 'Potion Merchant Manina',
    'region': 23687,
    'x': 832.15997,
    'z': 243.86,
    'y': 1093.64,
    'teleport': []
}, {
    'name': 'Potion Merchant Thiara',
    'region': 23602,
    'x': 829.46997,
    'z': 1407.65,
    'y': 346.16,
    'teleport': []
}, {
    'name': 'Potion Merchant Titi',
    'region': 23088,
    'x': 797.03003,
    'z': 863.28003,
    'y': 262.79999,
    'teleport': []
}, {
    'name': 'Potion Trader Abubark',
    'region': 22361,
    'x': 434.17999,
    'z': -431.94,
    'y': 1670.5,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 27244,
    'x': 90.389999,
    'z': 180.0,
    'y': 1680.98,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 26265,
    'x': 685.19,
    'z': -106.78,
    'y': 1462.54,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 23687,
    'x': 1045.1801,
    'z': 243.0,
    'y': 407.25,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 26959,
    'x': 693.48999,
    'z': 83.739998,
    'y': 641.67999,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 23088,
    'x': 454.59,
    'z': 863.34003,
    'y': 929.0,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 22106,
    'x': 1451.8,
    'z': -432.5,
    'y': 1441.9301,
    'teleport': []
}, {
    'name': 'Premium Service Manager Qing Yu',
    'region': 25000,
    'x': 1065.2,
    'z': 11.61,
    'y': 772.31,
    'teleport': []
}, {
    'name': 'Priate Blackbeard',
    'region': 25945,
    'x': 1323.33,
    'z': 26.93,
    'y': 999.60999,
    'teleport': [{
        'name': 'Harbor Manager Gale',
        'region': 25163,
        'x': 734,
        'z': -184,
        'y': 168
    }, {'name': 'Harbor Manager Marwa', 'region': 23856, 'x': 1525, 'z': 585, 'y': 1688}]
}, {
    'name': 'Protector Trader Aryoan',
    'region': 27499,
    'x': 1298.11,
    'z': 180.0,
    'y': 358.28,
    'teleport': []
}, {
    'name': 'Protector Trader Gonishya',
    'region': 23687,
    'x': 578.13,
    'z': 243.81,
    'y': 188.5,
    'teleport': []
}, {
    'name': 'Protector Trader Jatomo',
    'region': 26958,
    'x': 1910.98,
    'z': 83.870003,
    'y': 1083.46,
    'teleport': []
}, {
    'name': 'Protector Trader Mrs Jang',
    'region': 25000,
    'x': 332.17001,
    'z': 0.0,
    'y': 1085.23,
    'teleport': []
}, {
    'name': 'Protector Trader Yeolah',
    'region': 26265,
    'x': 1196.42,
    'z': -106.01,
    'y': 901.38,
    'teleport': []
}, {
    'name': 'Queen Sheherazade',
    'region': 22618,
    'x': 1366.6,
    'z': -236.59,
    'y': 129.67,
    'teleport': []
}, {
    'name': 'Repairer Uthman',
    'region': 22874,
    'x': 1594.33,
    'z': -430.84,
    'y': 1290.55,
    'teleport': []
}, {
    'name': 'Revolutionist Wing',
    'region': 23662,
    'x': 1755.89,
    'z': 4078.5901,
    'y': 59.09,
    'teleport': []
}, {
    'name': 'Royal Investigator Ijadun',
    'region': 20050,
    'x': 280.91,
    'z': -730.75,
    'y': 1489.41,
    'teleport': []
}, {
    'name': 'Royal Investigator Maribatun',
    'region': 20828,
    'x': 843.28998,
    'z': -195.52,
    'y': 1513.1,
    'teleport': []
}, {
    'name': 'Samarkand Goods Supplier Julia',
    'region': 27499,
    'x': 1636.65,
    'z': 180.0,
    'y': 282.54999,
    'teleport': []
}, {
    'name': 'Scout Commander Syujaatun',
    'region': 22611,
    'x': 858.20001,
    'z': 63.82,
    'y': 819.56,
    'teleport': []
}, {
    'name': 'Scout Force Soldier Amanun',
    'region': 22611,
    'x': 880.59003,
    'z': 61.119999,
    'y': 758.96997,
    'teleport': []
}, {
    'name': 'Scout Force Soldier Hadiun',
    'region': 22611,
    'x': 879.34998,
    'z': 60.580002,
    'y': 880.10999,
    'teleport': []
}, {
    'name': 'Scout Force Soldier Malarun',
    'region': 21594,
    'x': 1021.69,
    'z': -322.92999,
    'y': 1299.85,
    'teleport': []
}, {
    'name': 'Scout Force Soldier Nadamun',
    'region': 21594,
    'x': 1106.78,
    'z': -331.54999,
    'y': 1311.28,
    'teleport': []
}, {
    'name': 'Sealing Stone of Captain Ivy',
    'region': -32742,
    'x': 766.78998,
    'z': -134.5,
    'y': 1005.48,
    'teleport': []
}, {
    'name': 'Sealing Stone of Cerberus',
    'region': -32742,
    'x': 767.22998,
    'z': -134.5,
    'y': 1105.8199,
    'teleport': []
}, {
    'name': 'Sealing Stone of Isyutaru',
    'region': -32742,
    'x': 830.51001,
    'z': -134.5,
    'y': 823.97998,
    'teleport': []
}, {
    'name': 'Sealing Stone of Tigerwoman',
    'region': -32742,
    'x': 805.08002,
    'z': -134.5,
    'y': 1185.48,
    'teleport': []
}, {
    'name': 'Sealing Stone of Uruchi',
    'region': -32742,
    'x': 767.22998,
    'z': -134.5,
    'y': 895.53003,
    'teleport': []
}, {
    'name': 'Secret Agent Ayareotun',
    'region': 19279,
    'x': 646.03003,
    'z': -852.91998,
    'y': 1590.46,
    'teleport': []
}, {
    'name': 'Secret Agent Dilun',
    'region': 20566,
    'x': 1305.0601,
    'z': -487.63,
    'y': 1648.1,
    'teleport': []
}, {
    'name': 'Secret Agent Parun',
    'region': 20815,
    'x': 402.79999,
    'z': 202.64999,
    'y': 646.69,
    'teleport': []
}, {
    'name': 'Secret Agent Pulassun',
    'region': 20828,
    'x': 840.15002,
    'z': -192.66,
    'y': 1736.08,
    'teleport': []
}, {
    'name': 'Secret Agent Sirun',
    'region': 18769,
    'x': 1383.05,
    'z': -313.25,
    'y': 695.84003,
    'teleport': []
}, {
    'name': 'Secret Agent Tahatdi',
    'region': 20050,
    'x': 444.04999,
    'z': -703.22998,
    'y': 1763.88,
    'teleport': []
}, {
    'name': 'Secret Agent Tanahatun',
    'region': 21079,
    'x': 606.03998,
    'z': -324.45999,
    'y': 249.33,
    'teleport': []
}, {
    'name': 'Seiren Morphstone',
    'region': 27091,
    'x': 1142.8199,
    'z': 381.67001,
    'y': 810.04999,
    'teleport': []
}, {
    'name': 'Seiren Morphstone',
    'region': 27091,
    'x': 1142.17,
    'z': 381.82001,
    'y': 809.84998,
    'teleport': []
}, {
    'name': 'Slave Jabur',
    'region': 23918,
    'x': 770.06,
    'z': 3814.8799,
    'y': 384.17999,
    'teleport': []
}, {
    'name': 'Slave Shapeur',
    'region': 23925,
    'x': 1300.88,
    'z': 2835.98,
    'y': 1839.27,
    'teleport': []
}, {
    'name': 'Slave Shifle',
    'region': 22131,
    'x': 716.87,
    'z': 3628.3601,
    'y': 1097.73,
    'teleport': []
}, {
    'name': 'Slave Watcher Morphstone',
    'region': 27091,
    'x': 1141.88,
    'z': 381.85999,
    'y': 810.44,
    'teleport': []
}, {
    'name': 'Slave Watcher Morphstone',
    'region': 27091,
    'x': 1142.77,
    'z': 381.53,
    'y': 810.98999,
    'teleport': []
}, {
    'name': 'Smuggler Barus',
    'region': 27243,
    'x': 1424.25,
    'z': 180.0,
    'y': 458.57999,
    'teleport': []
}, {
    'name': 'Smuggler Chao',
    'region': 24999,
    'x': 1388.75,
    'z': 0.60000002,
    'y': 1291.9399,
    'teleport': []
}, {
    'name': 'Smuggler Chungho',
    'region': 26265,
    'x': 1595.45,
    'z': -106.15,
    'y': 869.58002,
    'teleport': []
}, {
    'name': 'Smuggler Dubai',
    'region': 22363,
    'x': 845.83002,
    'z': -319.95999,
    'y': 999.60999,
    'teleport': []
}, {
    'name': 'Smuggler Isutade',
    'region': 23431,
    'x': 920.19,
    'z': 99.470001,
    'y': 1074.83,
    'teleport': []
}, {
    'name': 'Smuggler Raul',
    'region': 26957,
    'x': 1674.33,
    'z': 80.0,
    'y': 468.89001,
    'teleport': []
}, {
    'name': 'Smuggler Road',
    'region': 23498,
    'x': 60.82,
    'z': -216.2,
    'y': 1765.33,
    'teleport': []
}, {
    'name': 'Smuggler Seek',
    'region': 23603,
    'x': 232.57001,
    'z': 1539.47,
    'y': 659.76001,
    'teleport': []
}, {
    'name': 'Solder Sangnam [Teleport]',
    'region': 25001,
    'x': 1387.17,
    'z': -0.07,
    'y': 1765.02,
    'teleport': [{
        'name': 'Soldier Choiyoung [Teleport]',
        'region': 25000,
        'x': 976,
        'z': -6,
        'y': 1834
    }, {
        'name': 'Soldier Jingyo [Teleport]',
        'region': 25000,
        'x': 983,
        'z': 0,
        'y': 77
    }, {'name': 'Soldier Hogang [Teleport]', 'region': 24999, 'x': 386, 'z': 0, 'y': 1900}]
}, {
    'name': 'Soldier Ahu',
    'region': 27499,
    'x': 116.52,
    'z': 180.0,
    'y': 190.25,
    'teleport': []
}, {
    'name': 'Soldier Alex',
    'region': 26957,
    'x': 1313.91,
    'z': 79.0,
    'y': 1408.13,
    'teleport': []
}, {
    'name': 'Soldier Asahap',
    'region': 27499,
    'x': 116.52,
    'z': 180.0,
    'y': 60.07,
    'teleport': []
}, {
    'name': 'Soldier Baeksong',
    'region': 26265,
    'x': 965.58002,
    'z': -105.45,
    'y': 268.07999,
    'teleport': []
}, {
    'name': 'Soldier Baoman',
    'region': 23688,
    'x': 1253.97,
    'z': 13.65,
    'y': 532.02002,
    'teleport': []
}, {
    'name': 'Soldier Batu',
    'region': 23686,
    'x': 1072.6899,
    'z': 13.43,
    'y': 420.76001,
    'teleport': []
}, {
    'name': 'Soldier Choiyoung [Teleport]',
    'region': 25000,
    'x': 1009.54,
    'z': 0.0,
    'y': 1902.64,
    'teleport': [{
        'name': 'Solder Sangnam [Teleport]',
        'region': 25001,
        'x': 1340,
        'z': 0,
        'y': 1817
    }, {
        'name': 'Soldier Jingyo [Teleport]',
        'region': 25000,
        'x': 983,
        'z': 0,
        'y': 77
    }, {'name': 'Soldier Hogang [Teleport]', 'region': 24999, 'x': 386, 'z': 0, 'y': 1900}]
}, {
    'name': 'Soldier Dangsam',
    'region': 25000,
    'x': 1037.3,
    'z': -0.44,
    'y': 30.209999,
    'teleport': []
}, {
    'name': 'Soldier Dohwa',
    'region': 27243,
    'x': 1862.65,
    'z': 180.0,
    'y': 218.23,
    'teleport': []
}, {
    'name': 'Soldier Dooil',
    'region': 26265,
    'x': 120.79,
    'z': -106.91,
    'y': 1831.87,
    'teleport': []
}, {
    'name': 'Soldier Duyun',
    'region': 23431,
    'x': 1088.89,
    'z': 13.29,
    'y': 377.60999,
    'teleport': []
}, {
    'name': 'Soldier Fengil',
    'region': 25000,
    'x': 937.54999,
    'z': 0.0,
    'y': 1902.71,
    'teleport': []
}, {
    'name': 'Soldier Hahun',
    'region': 26265,
    'x': 1715.52,
    'z': -106.7,
    'y': 1863.1,
    'teleport': []
}, {
    'name': 'Soldier Hogang [Teleport]',
    'region': 25255,
    'x': 334.98999,
    'z': -0.28,
    'y': 34.18,
    'teleport': [{
        'name': 'Soldier Choiyoung [Teleport]',
        'region': 25000,
        'x': 976,
        'z': -6,
        'y': 1834
    }, {
        'name': 'Solder Sangnam [Teleport]',
        'region': 25001,
        'x': 1340,
        'z': 0,
        'y': 1817
    }, {'name': 'Soldier Jingyo [Teleport]', 'region': 25000, 'x': 983, 'z': 0, 'y': 77}]
}, {
    'name': 'Soldier Iyang',
    'region': 25001,
    'x': 1387.87,
    'z': 0.0,
    'y': 1872.21,
    'teleport': []
}, {
    'name': 'Soldier Jingyo [Teleport]',
    'region': 25000,
    'x': 930.07001,
    'z': -0.41,
    'y': 30.66,
    'teleport': [{
        'name': 'Soldier Choiyoung [Teleport]',
        'region': 25000,
        'x': 976,
        'z': -6,
        'y': 1834
    }, {
        'name': 'Solder Sangnam [Teleport]',
        'region': 25001,
        'x': 1340,
        'z': 0,
        'y': 1817
    }, {'name': 'Soldier Hogang [Teleport]', 'region': 24999, 'x': 386, 'z': 0, 'y': 1900}]
}, {
    'name': 'Soldier Jooha',
    'region': 27500,
    'x': 1828.24,
    'z': 180.0,
    'y': 184.42,
    'teleport': []
}, {
    'name': 'Soldier Jowi',
    'region': 24999,
    'x': 334.39999,
    'z': -1.28,
    'y': 1849.16,
    'teleport': []
}, {
    'name': 'Soldier justia',
    'region': 26446,
    'x': 920.73999,
    'z': 82.019997,
    'y': 1896.6801,
    'teleport': []
}, {
    'name': 'Soldier Kartino',
    'region': 26704,
    'x': 652.34003,
    'z': -27.6,
    'y': 1690.0601,
    'teleport': [{'name': 'Thief Town', 'region': 24758, 'x': 760, 'z': -28, 'y': 900}]
}, {
    'name': 'Soldier Kasius',
    'region': 26959,
    'x': 124.36,
    'z': 80.0,
    'y': 1775.11,
    'teleport': []
}, {
    'name': 'Soldier Kotomo',
    'region': 27471,
    'x': 1375.22,
    'z': 80.0,
    'y': 557.54999,
    'teleport': []
}, {
    'name': 'Soldier Leihan',
    'region': 23431,
    'x': 1190.54,
    'z': 13.24,
    'y': 377.82999,
    'teleport': []
}, {
    'name': 'Soldier Makhan',
    'region': 23688,
    'x': 1253.6899,
    'z': 13.57,
    'y': 432.42999,
    'teleport': []
}, {
    'name': 'Soldier Manho',
    'region': 26521,
    'x': 120.42,
    'z': -106.96,
    'y': 0.62,
    'teleport': []
}, {
    'name': 'Soldier Maximus',
    'region': 26704,
    'x': 798.08002,
    'z': -27.6,
    'y': 1804.39,
    'teleport': []
}, {
    'name': 'Soldier Moho',
    'region': 26521,
    'x': 1715.15,
    'z': -106.7,
    'y': 40.759998,
    'teleport': []
}, {
    'name': 'Soldier Paje',
    'region': 27500,
    'x': 1827.9399,
    'z': 180.0,
    'y': 35.459999,
    'teleport': []
}, {
    'name': 'Soldier Pao',
    'region': 23943,
    'x': 1199.22,
    'z': 145.00999,
    'y': 1607.86,
    'teleport': []
}, {
    'name': 'Soldier Riedo',
    'region': 27471,
    'x': 1145.46,
    'z': 80.0,
    'y': 556.90002,
    'teleport': []
}, {
    'name': 'Soldier Takia',
    'region': 26957,
    'x': 1311.34,
    'z': 78.959999,
    'y': 1548.86,
    'teleport': []
}, {
    'name': 'Soldier Tapai',
    'region': 27244,
    'x': 75.919998,
    'z': 180.0,
    'y': 218.67999,
    'teleport': []
}, {
    'name': 'Soldier Tuolan',
    'region': 23943,
    'x': 1091.5601,
    'z': 145.32001,
    'y': 1607.77,
    'teleport': []
}, {
    'name': 'Soldier Vesaros',
    'region': 26959,
    'x': 29.459999,
    'z': 80.0,
    'y': 1675.27,
    'teleport': []
}, {
    'name': 'Soldier Wulan',
    'region': 23686,
    'x': 1072.95,
    'z': 13.43,
    'y': 523.54999,
    'teleport': []
}, {
    'name': 'Sorcerer Mouwasi',
    'region': 22354,
    'x': 667.81,
    'z': 299.85999,
    'y': 39.689999,
    'teleport': []
}, {
    'name': 'Specialty Abutalip',
    'region': 22617,
    'x': 536.96997,
    'z': -432.64001,
    'y': 1284.99,
    'teleport': []
}, {
    'name': 'Specialty Shop Elder Leegak',
    'region': 26265,
    'x': 393.06,
    'z': -106.62,
    'y': 1560.3101,
    'teleport': []
}, {
    'name': 'Specialty Trader Hounah',
    'region': 23445,
    'x': 1132.42,
    'z': 192.99001,
    'y': 833.71997,
    'teleport': []
}, {
    'name': 'Specialty Trader Hujaan',
    'region': 21833,
    'x': 1384.3,
    'z': -49.349998,
    'y': 304.78,
    'teleport': []
}, {
    'name': 'Specialty Trader Jodaesan',
    'region': 25000,
    'x': 1760.3199,
    'z': 11.0,
    'y': 480.22,
    'teleport': []
}, {
    'name': 'Specialty Trader Kaella',
    'region': 19266,
    'x': 1362.45,
    'z': 31.809999,
    'y': 3.2,
    'teleport': []
}, {
    'name': 'Specialty Trader Osaman',
    'region': 23411,
    'x': 377.14999,
    'z': 2628.78,
    'y': 104.86,
    'teleport': []
}, {
    'name': 'Specialty Trader Payi',
    'region': 26753,
    'x': 131.41,
    'z': 113.1,
    'y': 1404.95,
    'teleport': []
}, {
    'name': 'Specialty Trader Sanmok',
    'region': 23687,
    'x': 1515.55,
    'z': 243.99001,
    'y': 904.54999,
    'teleport': []
}, {
    'name': 'Specialty Trader Seopok',
    'region': 23712,
    'x': 411.03,
    'z': 1383.3199,
    'y': 1515.89,
    'teleport': []
}, {
    'name': 'Specialty Trader Tina',
    'region': 26959,
    'x': 351.01001,
    'z': 80.400002,
    'y': 228.24001,
    'teleport': []
}, {
    'name': 'Specialty Trader Toson',
    'region': 27244,
    'x': 837.14001,
    'z': 180.0,
    'y': 1823.25,
    'teleport': []
}, {
    'name': 'Specialty Trader Wasdi',
    'region': 23344,
    'x': 1112.25,
    'z': 930.13,
    'y': 1919.4,
    'teleport': []
}, {
    'name': 'Spice Trader Malak',
    'region': 22361,
    'x': 722.21002,
    'z': -431.98999,
    'y': 1464.3199,
    'teleport': []
}, {
    'name': 'Stable Keeper Ali',
    'region': 22874,
    'x': 289.39001,
    'z': -430.72,
    'y': 815.17999,
    'teleport': []
}, {
    'name': 'Stable Master Nefret',
    'region': 23089,
    'x': 867.84003,
    'z': 856.5,
    'y': 1644.05,
    'teleport': []
}, {
    'name': 'Stable-Keeper Hoyun',
    'region': 27500,
    'x': 686.56,
    'z': 180.0,
    'y': 246.67,
    'teleport': []
}, {
    'name': 'Stable-Keeper Machun',
    'region': 25000,
    'x': 329.20999,
    'z': 0.0,
    'y': 450.60001,
    'teleport': []
}, {
    'name': 'Stable-Keeper Makgo',
    'region': 26265,
    'x': 1415.0699,
    'z': -106.71,
    'y': 1651.6899,
    'teleport': []
}, {
    'name': 'Stable-Keeper Salihap',
    'region': 23431,
    'x': 1540.88,
    'z': 249.81,
    'y': 1873.05,
    'teleport': []
}, {
    'name': 'Stable-Keeper Treno',
    'region': 26958,
    'x': 1794.5,
    'z': 83.870003,
    'y': 366.17999,
    'teleport': []
}, {
    'name': 'Steward Yupitel',
    'region': 26958,
    'x': 635.78998,
    'z': 83.870003,
    'y': 1213.05,
    'teleport': []
}, {
    'name': 'Stolen Goods Dealer',
    'region': 24758,
    'x': 953.41998,
    'z': 3.6600001,
    'y': 1227.63,
    'teleport': []
}, {
    'name': 'Storage Keepeer Khamererne',
    'region': 23089,
    'x': 335.34,
    'z': 777.65997,
    'y': 798.67999,
    'teleport': []
}, {
    'name': 'Storage Keeper Abdullah',
    'region': 22106,
    'x': 1488.6,
    'z': -433.28,
    'y': 1682.8101,
    'teleport': []
}, {
    'name': 'Storage Keeper Asagon',
    'region': 23603,
    'x': 462.17001,
    'z': 1530.2,
    'y': 240.59,
    'teleport': []
}, {
    'name': 'Storage-Keeper Auisan',
    'region': 23687,
    'x': 1134.28,
    'z': 243.75,
    'y': 610.78998,
    'teleport': []
}, {
    'name': 'Storage-Keeper Irina',
    'region': 26265,
    'x': 1260.35,
    'z': -105.81,
    'y': 696.90002,
    'teleport': []
}, {
    'name': 'Storage-Keeper Paedo',
    'region': 26265,
    'x': 1260.35,
    'z': -105.81,
    'y': 696.84003,
    'teleport': []
}, {
    'name': 'Storage-Keeper Saesa',
    'region': 27244,
    'x': 563.42999,
    'z': 180.0,
    'y': 1131.66,
    'teleport': []
}, {
    'name': 'Storage-Keeper Sansan',
    'region': 25000,
    'x': 980.34998,
    'z': -32.52,
    'y': 989.19,
    'teleport': []
}, {
    'name': 'Storage-Keeper Wangu',
    'region': 25000,
    'x': 980.79999,
    'z': -32.43,
    'y': 989.13,
    'teleport': []
}, {
    'name': 'Sunset Witch',
    'region': 27728,
    'x': 1835.89,
    'z': 743.89001,
    'y': 1588.89,
    'teleport': []
}, {
    'name': 'Supply Assistant Titi',
    'region': 23498,
    'x': 116.36,
    'z': -206.58,
    'y': 1597.67,
    'teleport': []
}, {
    'name': 'Supply Soldier Born',
    'region': 23498,
    'x': 143.06,
    'z': -204.33,
    'y': 1650.92,
    'teleport': []
}, {
    'name': 'Survival Arena  Manager',
    'region': 22106,
    'x': 1677.08,
    'z': -433.28,
    'y': 1699.14,
    'teleport': []
}, {
    'name': 'Survival Arena  Manager',
    'region': 26959,
    'x': 482.19,
    'z': 83.739998,
    'y': 765.78998,
    'teleport': []
}, {
    'name': 'Survival Arena  Manager',
    'region': 23687,
    'x': 1210.4,
    'z': 245.85001,
    'y': 563.16998,
    'teleport': []
}, {
    'name': 'Survival Arena  Manager',
    'region': 25000,
    'x': 857.78998,
    'z': -34.52,
    'y': 828.58002,
    'teleport': []
}, {
    'name': 'Teleport Stone',
    'region': -32742,
    'x': 958.0,
    'z': -136.49001,
    'y': 1205.22,
    'teleport': []
}, {
    'name': 'Thief Associate',
    'region': 24758,
    'x': 982.67999,
    'z': 17.85,
    'y': 557.08002,
    'teleport': []
}, {
    'name': 'Thief Association Head Obad',
    'region': 22363,
    'x': 903.09998,
    'z': -319.92001,
    'y': 1383.15,
    'teleport': []
}, {
    'name': 'Thief Union Item Exchange manager Luresia',
    'region': 23346,
    'x': 1702.8,
    'z': 1403.63,
    'y': 1221.35,
    'teleport': []
}, {
    'name': 'Thief Union President Tausert',
    'region': 23347,
    'x': 361.16,
    'z': 1461.6,
    'y': 1849.8,
    'teleport': []
}, {
    'name': 'Thief Union Representative Mohaira',
    'region': -32752,
    'x': 4378.3301,
    'z': 67.470001,
    'y': 4144.8301,
    'teleport': []
}, {
    'name': 'Ticket Seller Gyoun',
    'region': 25001,
    'x': 183.8,
    'z': -35.990002,
    'y': 913.08002,
    'teleport': []
}, {
    'name': 'Tiger Bandit Band',
    'region': 24758,
    'x': 1137.6,
    'z': -27.34,
    'y': 887.90997,
    'teleport': []
}, {
    'name': 'Tomb Snake Lady Morphstone',
    'region': 27091,
    'x': 1142.14,
    'z': 381.0,
    'y': 810.89001,
    'teleport': []
}, {
    'name': 'Tomb Snake Lady Morphstone',
    'region': 27091,
    'x': 1142.53,
    'z': 381.26999,
    'y': 810.32001,
    'teleport': []
}, {
    'name': 'Towner Anashya',
    'region': 23155,
    'x': 739.46997,
    'z': 2505.3101,
    'y': 782.83002,
    'teleport': []
}, {
    'name': 'Towner Isan',
    'region': 23914,
    'x': 1167.5,
    'z': 2815.0801,
    'y': 370.85001,
    'teleport': []
}, {
    'name': 'Towner Salrihan',
    'region': 22125,
    'x': 616.32001,
    'z': 2584.9299,
    'y': 698.73999,
    'teleport': []
}, {
    'name': 'Trade merchant Shadia',
    'region': 22874,
    'x': 846.90997,
    'z': -430.70999,
    'y': 872.87,
    'teleport': []
}, {
    'name': 'Trader Alice',
    'region': 23498,
    'x': 393.62,
    'z': -207.61,
    'y': 1752.47,
    'teleport': []
}, {
    'name': 'Trader Anna',
    'region': 26958,
    'x': 1779.5601,
    'z': 83.870003,
    'y': 1279.52,
    'teleport': []
}, {
    'name': 'Trader Dena',
    'region': 23088,
    'x': 419.28,
    'z': 863.31,
    'y': 243.46001,
    'teleport': []
}, {
    'name': 'Trader Sabonue',
    'region': 23687,
    'x': 1486.86,
    'z': 243.81,
    'y': 10.69,
    'teleport': []
}, {
    'name': 'Trader Samanda',
    'region': 27243,
    'x': 1475.9,
    'z': 180.0,
    'y': 1661.35,
    'teleport': []
}, {
    'name': 'Trader Sunwha',
    'region': 26265,
    'x': 580.46002,
    'z': -104.54,
    'y': 387.51999,
    'teleport': []
}, {
    'name': 'Trader Union President Naunakt',
    'region': 23600,
    'x': 798.62,
    'z': 930.65997,
    'y': 112.95,
    'teleport': []
}, {
    'name': 'Trader Yusun',
    'region': 25000,
    'x': 1572.52,
    'z': 0.0,
    'y': 567.32001,
    'teleport': []
}, {
    'name': 'Trial Box',
    'region': -32762,
    'x': -18147.48,
    'z': -47.240002,
    'y': -29.969999,
    'teleport': []
}, {
    'name': 'Tunnel Manager Asui',
    'region': 26237,
    'x': 158.16,
    'z': 393.60999,
    'y': 614.88,
    'teleport': [{'name': 'Tunnel Manager Topni', 'region': 27000, 'x': 1072, 'z': 598, 'y': 1822}]
}, {
    'name': 'Tunnel Manager Maryokuk',
    'region': 25469,
    'x': 183.17999,
    'z': 256.87,
    'y': 437.25,
    'teleport': [{'name': 'Tunnel Manager Salhap', 'region': 26232, 'x': 1372, 'z': 183, 'y': 1844}]
}, {
    'name': 'Tunnel Manager Salhap',
    'region': 26232,
    'x': 1489.76,
    'z': 185.39,
    'y': 1842.9399,
    'teleport': [{'name': 'Tunnel Manager Maryokuk', 'region': 25469, 'x': 376, 'z': 244, 'y': 486}]
}, {
    'name': 'Tunnel Manager Topni',
    'region': 27000,
    'x': 1195.11,
    'z': 598.15002,
    'y': 1826.79,
    'teleport': [{'name': 'Tunnel Manager Asui', 'region': 26237, 'x': 362, 'z': 393, 'y': 599}]
}, {
    'name': 'Vicious Desperado',
    'region': 24758,
    'x': 1424.28,
    'z': 9.9300003,
    'y': 1376.74,
    'teleport': []
}, {
    'name': 'Village Chief Bukra',
    'region': 23411,
    'x': 971.28003,
    'z': 2555.6201,
    'y': 55.950001,
    'teleport': []
}, {
    'name': 'Village Chief Hwangno',
    'region': 25001,
    'x': 850.02002,
    'z': 0.0,
    'y': 1433.16,
    'teleport': []
}, {
    'name': 'Village Man Itzak',
    'region': 22107,
    'x': 126.92,
    'z': -433.28,
    'y': 1473.71,
    'teleport': []
}, {
    'name': 'Village Man Phuad',
    'region': 22875,
    'x': 972.06,
    'z': -430.56,
    'y': 548.69,
    'teleport': []
}, {
    'name': 'Village Man Yamain',
    'region': 22106,
    'x': 1285.73,
    'z': -432.13,
    'y': 769.21997,
    'teleport': []
}, {
    'name': 'Village Old Man Kerim',
    'region': 22106,
    'x': 349.45001,
    'z': -432.13,
    'y': 1509.2,
    'teleport': [{'name': 'Baghdad(Dungeon)', 'region': 23636, 'x': 1577, 'z': -430, 'y': 1105}]
}, {
    'name': 'Village Woman Nazima',
    'region': 22361,
    'x': 925.90997,
    'z': -432.13,
    'y': 265.14999,
    'teleport': []
}, {
    'name': 'Village Woman Sa\'adatun',
    'region': 22107,
    'x': 969.20001,
    'z': -433.28,
    'y': 1536.98,
    'teleport': []
}, {
    'name': 'Village Woman Zvaida',
    'region': 22107,
    'x': 457.10999,
    'z': -433.28,
    'y': 1648.6,
    'teleport': []
}, {
    'name': 'WalYoung',
    'region': 25001,
    'x': 859.03998,
    'z': 0.0,
    'y': 1069.34,
    'teleport': []
}, {
    'name': 'Weapon Trader Balbardo',
    'region': 26959,
    'x': 784.69,
    'z': 83.459999,
    'y': 1532.71,
    'teleport': []
}, {
    'name': 'Weapon Trader Chunmoo',
    'region': 23346,
    'x': 648.39001,
    'z': 1310.96,
    'y': 1730.5,
    'teleport': []
}, {
    'name': 'Weapon Trader Hemaka',
    'region': 23087,
    'x': 1572.84,
    'z': 863.31,
    'y': 1069.86,
    'teleport': []
}, {
    'name': 'Weapon Trader Tricia',
    'region': 27499,
    'x': 1762.61,
    'z': 180.0,
    'y': 809.78003,
    'teleport': []
}, {
    'name': 'Windy Phantom Thief',
    'region': 24758,
    'x': 635.94,
    'z': 19.360001,
    'y': 397.26001,
    'teleport': []
}, {
    'name': 'Yeoha Morphstone',
    'region': 27091,
    'x': 1141.92,
    'z': 382.16,
    'y': 1127.97,
    'teleport': []
}, {'name': 'Yeoha Morphstone', 'region': 27091, 'x': 1142.3199, 'z': 381.67001, 'y': 1127.0699, 'teleport': []}];
let ul_NPCs = $('#navigation-npc .sidebar-submenu ul');
let html;

for (let i = 0; i < NPCs.length; i++) {
    // Create html
    html = '<b>' + NPCs[i].name + '</b>';
    for (let j = 0; j < NPCs[i].teleport.length; j++)
        html += '<br><a href="#" onclick="xSROMap.FlyView(' + NPCs[i].teleport[j].x + ',' + NPCs[i].teleport[j].y + ',' + NPCs[i].teleport[j].z + ',' + NPCs[i].teleport[j].region + ')">' + NPCs[i].teleport[j].name + '</a>';
    // Add to map
    xSROMap.AddNPC(i, html, NPCs[i].x, NPCs[i].y, NPCs[i].z, NPCs[i].region);
    // Add to GUI
    ul_NPCs.append('<li><a href="#" onclick="xSROMap.GoToNPC(' + i + ')">' + NPCs[i].name + '</a></li>');
}
// Add Teleports: [ { name , x , z , y , region , type,  teleport : [ { name , x , z , y , region } , ... ] } , ...]
let TPs = [{
    'name': 'Dimensional Gate',
    'region': 25000,
    'x': 1254,
    'z': -6,
    'y': 1374,
    'teleport': [{'name': 'Donwhang', 'region': 26265, 'x': 957, 'z': -80, 'y': 1508}, {
        'name': 'Alexandria (South)',
        'region': 23088,
        'x': 663,
        'z': 863,
        'y': 526
    }, {'name': 'Alexandria (North)', 'region': 23603, 'x': 111, 'z': 1537, 'y': 524}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 26521,
    'x': 962,
    'z': -35,
    'y': 8,
    'teleport': [{'name': 'Jangan', 'region': 25000, 'x': 969, 'z': 0, 'y': 1369}, {
        'name': 'Hotan',
        'region': 23687,
        'x': 1138,
        'z': 250,
        'y': 153
    }],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 23687,
    'x': 1131,
    'z': 305,
    'y': 488,
    'teleport': [{'name': 'Donwhang', 'region': 26265, 'x': 957, 'z': -80, 'y': 1508}, {
        'name': 'Samarkand',
        'region': 27244,
        'x': 270,
        'z': 180,
        'y': 1421
    }, {'name': 'Alexandria (South)', 'region': 23088, 'x': 663, 'z': 863, 'y': 526}, {
        'name': 'Alexandria (North)',
        'region': 23603,
        'x': 111,
        'z': 1537,
        'y': 524
    }, {'name': 'Baghdad', 'region': 22618, 'x': 1075, 'z': -236, 'y': 323}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 26959,
    'x': 700,
    'z': 200,
    'y': 886,
    'teleport': [{'name': 'Samarkand', 'region': 27244, 'x': 270, 'z': 180, 'y': 1421}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 27499,
    'x': 1917,
    'z': 250,
    'y': 108,
    'teleport': [{'name': 'Constantinople', 'region': 26959, 'x': 950, 'z': 84, 'y': 1070}, {
        'name': 'Hotan',
        'region': 23687,
        'x': 1138,
        'z': 250,
        'y': 153
    }],
    'type': 0
}, {
    'name': 'Gate of Fortress (I)',
    'region': 17221,
    'x': 1115,
    'z': 60,
    'y': 490,
    'teleport': [{
        'name': 'Gate I of Jangan Fortress',
        'region': 23719,
        'x': 465,
        'z': 145,
        'y': 363
    }, {
        'name': 'Gate II of Jangan Fortress',
        'region': 23720,
        'x': 72,
        'z': 250,
        'y': 162
    }, {'name': 'Gate III of Jangan Fortress', 'region': 23721, 'x': 439, 'z': 14, 'y': 413}],
    'type': 1
}, {
    'name': 'Gate of Fortress (II)',
    'region': 17222,
    'x': 1118,
    'z': 46,
    'y': 452,
    'teleport': [{
        'name': 'Gate I of Jangan Fortress',
        'region': 23719,
        'x': 465,
        'z': 145,
        'y': 363
    }, {
        'name': 'Gate II of Jangan Fortress',
        'region': 23720,
        'x': 72,
        'z': 250,
        'y': 162
    }, {'name': 'Gate III of Jangan Fortress', 'region': 23721, 'x': 439, 'z': 14, 'y': 413}],
    'type': 1
}, {
    'name': 'Gate of Fortress (III)',
    'region': 17225,
    'x': 1259,
    'z': 30,
    'y': 364,
    'teleport': [{
        'name': 'Gate I of Jangan Fortress',
        'region': 23719,
        'x': 465,
        'z': 145,
        'y': 363
    }, {
        'name': 'Gate II of Jangan Fortress',
        'region': 23720,
        'x': 72,
        'z': 250,
        'y': 162
    }, {'name': 'Gate III of Jangan Fortress', 'region': 23721, 'x': 439, 'z': 14, 'y': 413}],
    'type': 1
}, {
    'name': 'Gate of Charge',
    'region': 17989,
    'x': 619,
    'z': 46,
    'y': 915,
    'teleport': [{
        'name': 'Gate of Glory',
        'region': 17224,
        'x': 467,
        'z': 0,
        'y': 736
    }, {'name': 'Gate of Resurrection', 'region': 17735, 'x': 795, 'z': 0, 'y': 1407}],
    'type': 3
}, {
    'name': 'Gate of Glory',
    'region': 17224,
    'x': 482,
    'z': 20,
    'y': 439,
    'teleport': [{
        'name': 'Gate of Charge',
        'region': 17989,
        'x': 885,
        'z': 31,
        'y': 914
    }, {'name': 'Gate of Resurrection', 'region': 17735, 'x': 795, 'z': 0, 'y': 1407}],
    'type': 3
}, {
    'name': 'Gate of Resurrection',
    'region': 17735,
    'x': 796,
    'z': 15,
    'y': 1472,
    'teleport': [{'name': 'Gate of Charge', 'region': 17989, 'x': 885, 'z': 31, 'y': 914}, {
        'name': 'Gate of Glory',
        'region': 17224,
        'x': 467,
        'z': 0,
        'y': 736
    }, {'name': 'Jangan', 'region': 25000, 'x': 969, 'z': 0, 'y': 1369}],
    'type': 2
}, {
    'name': 'Gate of Fortress (I)',
    'region': 17997,
    'x': 750,
    'z': 953,
    'y': 1258,
    'teleport': [{
        'name': 'Gate I of Bandit Fortress',
        'region': 23714,
        'x': 1830,
        'z': 1196,
        'y': 1146
    }, {'name': 'Gate II of Bandit Fortress', 'region': 23459, 'x': 462, 'z': 1286, 'y': 1491}],
    'type': 1
}, {
    'name': 'Gate of Fortress (II)',
    'region': 17999,
    'x': 982,
    'z': 671,
    'y': 1244,
    'teleport': [{
        'name': 'Gate I of Bandit Fortress',
        'region': 23714,
        'x': 1830,
        'z': 1196,
        'y': 1146
    }, {'name': 'Gate II of Bandit Fortress', 'region': 23459, 'x': 462, 'z': 1286, 'y': 1491}],
    'type': 1
}, {
    'name': 'Gate of Fortress (III)',
    'region': 18000,
    'x': 1034,
    'z': 712,
    'y': 1468,
    'teleport': [{
        'name': 'Gate I of Bandit Fortress',
        'region': 23714,
        'x': 1830,
        'z': 1196,
        'y': 1146
    }, {'name': 'Gate II of Bandit Fortress', 'region': 23459, 'x': 462, 'z': 1286, 'y': 1491}],
    'type': 1
}, {
    'name': 'Gate of Charge',
    'region': 17743,
    'x': 1499,
    'z': 939,
    'y': 827,
    'teleport': [{
        'name': 'Gate of Glory',
        'region': 17998,
        'x': 448,
        'z': 842,
        'y': 1083
    }, {'name': 'Gate of Resurrection', 'region': 17231, 'x': 298, 'z': 1377, 'y': 584}],
    'type': 3
}, {
    'name': 'Gate of Glory',
    'region': 17998,
    'x': 446,
    'z': 860,
    'y': 1356,
    'teleport': [{
        'name': 'Gate of Charge',
        'region': 17743,
        'x': 1746,
        'z': 932,
        'y': 834
    }, {'name': 'Gate of Resurrection', 'region': 17231, 'x': 298, 'z': 1377, 'y': 584}],
    'type': 3
}, {
    'name': 'Gate of Resurrection',
    'region': 17231,
    'x': 101,
    'z': 1391,
    'y': 587,
    'teleport': [{'name': 'Gate of Charge', 'region': 17743, 'x': 1746, 'z': 932, 'y': 834}, {
        'name': 'Gate of Glory',
        'region': 17998,
        'x': 448,
        'z': 842,
        'y': 1083
    }, {'name': 'Jangan', 'region': 25000, 'x': 969, 'z': 0, 'y': 1369}],
    'type': 2
}, {
    'name': 'Dimensional Gate',
    'region': -32766,
    'x': 370,
    'z': 1900,
    'y': 830,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -13674, 'z': 0, 'y': 5596}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': -32766,
    'x': 710,
    'z': 1900,
    'y': -295,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.4', 'region': -32764, 'x': -15043, 'z': -98, 'y': 19789}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': -32766,
    'x': -500,
    'z': 1900,
    'y': -590,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': 352, 'z': 72, 'y': 78}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': -32766,
    'x': -738,
    'z': 1900,
    'y': 489,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.1', 'region': -32761, 'x': -1, 'z': -11, 'y': -3200}],
    'type': 0
}, {
    'name': 'Gate of Jangan Fortress (I)',
    'region': 23719,
    'x': 147,
    'z': 175,
    'y': 538,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 17221,
        'x': 812,
        'z': 31,
        'y': 677
    }, {'name': 'Gate II of Fortress', 'region': 17222, 'x': 1465, 'z': 13, 'y': 362}, {
        'name': 'Gate III of Fortress',
        'region': 17225,
        'x': 894,
        'z': 1,
        'y': 332
    }],
    'type': 1
}, {
    'name': 'Gate of Jangan Fortress (II)',
    'region': 23720,
    'x': 118,
    'z': 200,
    'y': 504,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 17221,
        'x': 812,
        'z': 31,
        'y': 677
    }, {'name': 'Gate II of Fortress', 'region': 17222, 'x': 1465, 'z': 13, 'y': 362}, {
        'name': 'Gate III of Fortress',
        'region': 17225,
        'x': 894,
        'z': 1,
        'y': 332
    }],
    'type': 1
}, {
    'name': 'Gate of Jangan Fortress (III)',
    'region': 23721,
    'x': 808,
    'z': 41,
    'y': 522,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 17221,
        'x': 812,
        'z': 31,
        'y': 677
    }, {'name': 'Gate II of Fortress', 'region': 17222, 'x': 1465, 'z': 13, 'y': 362}, {
        'name': 'Gate III of Fortress',
        'region': 17225,
        'x': 894,
        'z': 1,
        'y': 332
    }],
    'type': 1
}, {
    'name': 'Gate of Bandit Fortress (I)',
    'region': 23715,
    'x': 196,
    'z': 1262,
    'y': 1145,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 17997,
        'x': 747,
        'z': 923,
        'y': 956
    }, {'name': 'Gate II of Fortress', 'region': 17999, 'x': 984, 'z': 644, 'y': 943}, {
        'name': 'Gate III of Fortress',
        'region': 18000,
        'x': 1034,
        'z': 682,
        'y': 1156
    }],
    'type': 4
}, {
    'name': 'Gate of Bandit Fortress (II)',
    'region': 23459,
    'x': 572,
    'z': 1311,
    'y': 1791,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 17997,
        'x': 747,
        'z': 923,
        'y': 956
    }, {'name': 'Gate II of Fortress', 'region': 17999, 'x': 984, 'z': 644, 'y': 943}, {
        'name': 'Gate III of Fortress',
        'region': 18000,
        'x': 1034,
        'z': 682,
        'y': 1156
    }],
    'type': 4
}, {
    'name': 'Gate of Hotan Fortress (I)',
    'region': 24710,
    'x': 593,
    'z': -4,
    'y': 50,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 14661,
        'x': 2,
        'z': -90,
        'y': 1565
    }, {'name': 'Gate II of Fortress', 'region': 14662, 'x': 36, 'z': -74, 'y': 1470}, {
        'name': 'Gate III of Fortress',
        'region': 14663,
        'x': 153,
        'z': 40,
        'y': 1298
    }, {'name': 'Gate IV of Fortress', 'region': 14664, 'x': 228, 'z': 80, 'y': 1111}],
    'type': 1
}, {
    'name': 'Gate of Hotan Fortress (II)',
    'region': 24711,
    'x': 382,
    'z': 63,
    'y': 446,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 14661,
        'x': 2,
        'z': -90,
        'y': 1565
    }, {'name': 'Gate II of Fortress', 'region': 14662, 'x': 36, 'z': -74, 'y': 1470}, {
        'name': 'Gate III of Fortress',
        'region': 14663,
        'x': 153,
        'z': 40,
        'y': 1298
    }, {'name': 'Gate IV of Fortress', 'region': 14664, 'x': 228, 'z': 80, 'y': 1111}],
    'type': 1
}, {
    'name': 'Gate of Hotan Fortress (III)',
    'region': 24711,
    'x': 1812,
    'z': 61,
    'y': 877,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 14661,
        'x': 2,
        'z': -90,
        'y': 1565
    }, {'name': 'Gate II of Fortress', 'region': 14662, 'x': 36, 'z': -74, 'y': 1470}, {
        'name': 'Gate III of Fortress',
        'region': 14663,
        'x': 153,
        'z': 40,
        'y': 1298
    }, {'name': 'Gate IV of Fortress', 'region': 14664, 'x': 228, 'z': 80, 'y': 1111}],
    'type': 1
}, {
    'name': 'Gate of Fortress (I)',
    'region': 14661,
    'x': 20,
    'z': 19,
    'y': 1103,
    'teleport': [{
        'name': 'Gate I of Hotan Fortress',
        'region': 24710,
        'x': 579,
        'z': -39,
        'y': 345
    }, {
        'name': 'Gate II of Hotan Fortress',
        'region': 24711,
        'x': 386,
        'z': 43,
        'y': 694
    }, {'name': 'Gate III of Hotan Fortress', 'region': 24711, 'x': 1691, 'z': 33, 'y': 1072}],
    'type': 1
}, {
    'name': 'Gate of Fortress (II)',
    'region': 14662,
    'x': 11,
    'z': -20,
    'y': 1147,
    'teleport': [{
        'name': 'Gate I of Hotan Fortress',
        'region': 24710,
        'x': 579,
        'z': -39,
        'y': 345
    }, {
        'name': 'Gate II of Hotan Fortress',
        'region': 24711,
        'x': 386,
        'z': 43,
        'y': 694
    }, {'name': 'Gate III of Hotan Fortress', 'region': 24711, 'x': 1691, 'z': 33, 'y': 1072}],
    'type': 1
}, {
    'name': 'Gate of Fortress (III)',
    'region': 14663,
    'x': 10,
    'z': 70,
    'y': 1124,
    'teleport': [{
        'name': 'Gate I of Hotan Fortress',
        'region': 24710,
        'x': 579,
        'z': -39,
        'y': 345
    }, {
        'name': 'Gate II of Hotan Fortress',
        'region': 24711,
        'x': 386,
        'z': 43,
        'y': 694
    }, {'name': 'Gate III of Hotan Fortress', 'region': 24711, 'x': 1691, 'z': 33, 'y': 1072}],
    'type': 1
}, {
    'name': 'Gate of Fortress (IV)',
    'region': 14664,
    'x': 9,
    'z': 110,
    'y': 1034,
    'teleport': [{
        'name': 'Gate I of Hotan Fortress',
        'region': 24710,
        'x': 579,
        'z': -39,
        'y': 345
    }, {
        'name': 'Gate II of Hotan Fortress',
        'region': 24711,
        'x': 386,
        'z': 43,
        'y': 694
    }, {'name': 'Gate III of Hotan Fortress', 'region': 24711, 'x': 1691, 'z': 33, 'y': 1072}],
    'type': 1
}, {
    'name': 'Gate of Charge',
    'region': 15172,
    'x': 753,
    'z': 62,
    'y': 8,
    'teleport': [{
        'name': 'Gate of Glory',
        'region': 15176,
        'x': 1583,
        'z': -64,
        'y': 374
    }, {'name': 'Gate of Resurrection', 'region': 15175, 'x': 1417, 'z': 85, 'y': 160}],
    'type': 3
}, {
    'name': 'Gate of Glory',
    'region': 15176,
    'x': 1787,
    'z': -25,
    'y': 358,
    'teleport': [{
        'name': 'Gate of Charge',
        'region': 15172,
        'x': 808,
        'z': 46,
        'y': 118
    }, {'name': 'Gate of Resurrection', 'region': 15175, 'x': 1417, 'z': 85, 'y': 160}],
    'type': 3
}, {
    'name': 'Gate of Resurrection',
    'region': 15175,
    'x': 1633,
    'z': 99,
    'y': 47,
    'teleport': [{'name': 'Gate of Charge', 'region': 15172, 'x': 808, 'z': 46, 'y': 118}, {
        'name': 'Gate of Glory',
        'region': 15176,
        'x': 1583,
        'z': -64,
        'y': 374
    }, {'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}],
    'type': 2
}, {
    'name': 'Gate of Ruler',
    'region': 23406,
    'x': 1883,
    'z': 4138,
    'y': 1912,
    'teleport': [{'name': 'GATE_RC_ROC_GATE', 'region': 26045, 'x': 1027, 'z': -41, 'y': 822}],
    'type': 6
}, {
    'name': 'Dimensional Gate (Enterance of Pharaoh tomb)',
    'region': 19019,
    'x': 1690,
    'z': 600,
    'y': 1782,
    'teleport': [{
        'name': 'Pharaoh tomb (beginner)',
        'region': 29631,
        'x': 1559,
        'z': 755,
        'y': 1775
    }, {
        'name': 'Pharaoh tomb (intermediate)',
        'region': 31423,
        'x': 1559,
        'z': 755,
        'y': 1775
    }, {'name': 'Pharaoh tomb (advance)', 'region': 31410, 'x': 1559, 'z': 755, 'y': 1775}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of beginner Pharaoh tomb)',
    'region': 29631,
    'x': 1270,
    'z': 735,
    'y': 1779,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of intermediate Pharaoh tomb)',
    'region': 31423,
    'x': 1270,
    'z': 735,
    'y': 1779,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of advanced Pharaoh tomb)',
    'region': 31410,
    'x': 1270,
    'z': 735,
    'y': 1779,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of beginner Pharaoh tomb)',
    'region': 29380,
    'x': 533,
    'z': 815,
    'y': 730,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of intermediate Pharaoh tomb)',
    'region': 31172,
    'x': 533,
    'z': 815,
    'y': 730,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Exit of advanced Pharaoh tomb)',
    'region': 31159,
    'x': 533,
    'z': 815,
    'y': 730,
    'teleport': [{'name': 'Kings Valley', 'region': 19019, 'x': 202, 'z': 398, 'y': 1782}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Hunter Entrance)',
    'region': 22347,
    'x': 1627,
    'z': 300,
    'y': 554,
    'teleport': [{'name': 'Temple', 'region': -32752, 'x': -4027, 'z': 58, 'y': -3717}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 21067,
    'x': 1470,
    'z': 300,
    'y': 301,
    'teleport': [{'name': 'Temple', 'region': -32752, 'x': 4376, 'z': 55, 'y': 4707}],
    'type': 0
}, {
    'name': 'Dimensional Gate (South)',
    'region': 23088,
    'x': 612,
    'z': 910,
    'y': 1089,
    'teleport': [{'name': 'Jangan', 'region': 25000, 'x': 969, 'z': 0, 'y': 1369}, {
        'name': 'Hotan',
        'region': 23687,
        'x': 1138,
        'z': 250,
        'y': 153
    }, {'name': 'Alexandria (North)', 'region': 23603, 'x': 111, 'z': 1537, 'y': 524}, {
        'name': 'Baghdad',
        'region': 22618,
        'x': 1075,
        'z': -236,
        'y': 323
    }],
    'type': 0
}, {
    'name': 'Dimensional Gate (North)',
    'region': 23602,
    'x': 1719,
    'z': 1586,
    'y': 760,
    'teleport': [{'name': 'Jangan', 'region': 25000, 'x': 969, 'z': 0, 'y': 1369}, {
        'name': 'Hotan',
        'region': 23687,
        'x': 1138,
        'z': 250,
        'y': 153
    }, {'name': 'Alexandria (South)', 'region': 23088, 'x': 663, 'z': 863, 'y': 526}, {
        'name': 'Baghdad',
        'region': 22618,
        'x': 1075,
        'z': -236,
        'y': 323
    }],
    'type': 0
}, {
    'name': 'Dimensional Gate (Delta Area)',
    'region': 23608,
    'x': 459,
    'z': 1230,
    'y': 1264,
    'teleport': [{'name': 'Storm and cloud Desert', 'region': 21569, 'x': 1206, 'z': 218, 'y': 1822}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Delta Area)',
    'region': 21812,
    'x': 937,
    'z': 697,
    'y': 1392,
    'teleport': [{'name': 'Kings Valley', 'region': 19001, 'x': 910, 'z': 221, 'y': 1793}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 21569,
    'x': 486,
    'z': 486,
    'y': 1918,
    'teleport': [{'name': 'abundance ground', 'region': 23608, 'x': 171, 'z': 1179, 'y': 828}],
    'type': 0
}, {
    'name': 'Dimensional Gate (Kings Valley)',
    'region': 19001,
    'x': 262,
    'z': 430,
    'y': 1903,
    'teleport': [{'name': 'forbidden plain', 'region': 21812, 'x': 1151, 'z': 613, 'y': 1636}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 24902,
    'x': 1490,
    'z': 477,
    'y': 1831,
    'teleport': [{'name': 'Mirror Dimension', 'region': 23498, 'x': 253, 'z': -204, 'y': 1519}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 23498,
    'x': 155,
    'z': -210,
    'y': 1530,
    'teleport': [{'name': 'Original World', 'region': 25158, 'x': 1506, 'z': 476, 'y': 27}],
    'type': 0
}, {
    'name': 'Temple of Jupiter Entrance',
    'region': 22219,
    'x': 824,
    'z': 476,
    'y': 1804,
    'teleport': [{
        'name': 'Hall of Worship Beginner',
        'region': 32236,
        'x': 950,
        'z': 880,
        'y': 900
    }, {
        'name': 'Hall of Worship Intermediate-111Lv',
        'region': 32236,
        'x': 950,
        'z': 880,
        'y': 900
    }, {
        'name': 'Hall of Worship Advanced-113Lv',
        'region': 32236,
        'x': 830,
        'z': 880,
        'y': 900
    }, {
        'name': 'Zealots Hideout Beginner',
        'region': -32746,
        'x': -2,
        'z': 1,
        'y': -137
    }, {
        'name': 'Zealots Hideout Intermediate-116Lv',
        'region': -32746,
        'x': -2,
        'z': 1,
        'y': -137
    }, {'name': 'Zealots Hideout Advanced-118Lv', 'region': -32746, 'x': 1080, 'z': 1, 'y': 630}],
    'type': 0
}, {
    'name': 'Hall of Worship',
    'region': 32236,
    'x': 990,
    'z': 870,
    'y': 860,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Hall of Worship',
    'region': 32236,
    'x': 990,
    'z': 870,
    'y': 860,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 2,
    'z': 1,
    'y': 14,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 2,
    'z': 1,
    'y': 14,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 1730,
    'z': 1,
    'y': 1000,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 1730,
    'z': 1,
    'y': 1000,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': -1700,
    'z': 1,
    'y': 970,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 0,
    'z': 1,
    'y': -1960,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': -1700,
    'z': 1,
    'y': 970,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 0,
    'z': 1,
    'y': -1960,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Hall of Worship',
    'region': 32236,
    'x': 990,
    'z': 870,
    'y': 860,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Zealots Hideout',
    'region': -32746,
    'x': 2,
    'z': 1,
    'y': 14,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'GATE_JUPITER_B0_1',
    'region': -32746,
    'x': 0,
    'z': 1,
    'y': -1960,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'GATE_JUPITER_B0_2',
    'region': -32746,
    'x': -1700,
    'z': 1,
    'y': 970,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'GATE_JUPITER_B0_3',
    'region': -32746,
    'x': 1730,
    'z': 1,
    'y': 1000,
    'teleport': [{'name': 'Temple of Jupiter Entrance', 'region': 22219, 'x': 837, 'z': 475, 'y': 1901}],
    'type': 0
}, {
    'name': 'Dimensional Gate',
    'region': 22618,
    'x': 1015,
    'z': -236,
    'y': 607,
    'teleport': [{'name': 'Hotan', 'region': 23687, 'x': 1138, 'z': 250, 'y': 153}, {
        'name': 'Alexandria (South)',
        'region': 23088,
        'x': 663,
        'z': 863,
        'y': 526
    }, {'name': 'Alexandria (North)', 'region': 23603, 'x': 111, 'z': 1537, 'y': 524}],
    'type': 0
}, {
    'name': 'Portal (C)',
    'region': 22362,
    'x': 1359,
    'z': -236,
    'y': 1879,
    'teleport': [{'name': 'Portal (N)', 'region': 22874, 'x': 1798, 'z': -430, 'y': 835}, {
        'name': 'Portal (W)',
        'region': 22617,
        'x': 724,
        'z': -431,
        'y': 481
    }, {'name': 'Portal (S)', 'region': 22106, 'x': 1316, 'z': -432, 'y': 832}],
    'type': 0
}, {
    'name': 'Portal (N)',
    'region': 22874,
    'x': 1864,
    'z': -430,
    'y': 931,
    'teleport': [{'name': 'Portal (C)', 'region': 22618, 'x': 1287, 'z': -236, 'y': 36}, {
        'name': 'Portal (W)',
        'region': 22617,
        'x': 724,
        'z': -431,
        'y': 481
    }, {'name': 'Portal (S)', 'region': 22106, 'x': 1316, 'z': -432, 'y': 832}],
    'type': 0
}, {
    'name': 'Portal (W)',
    'region': 22617,
    'x': 826,
    'z': -430,
    'y': 517,
    'teleport': [{'name': 'Portal (C)', 'region': 22618, 'x': 1287, 'z': -236, 'y': 36}, {
        'name': 'Portal (N)',
        'region': 22874,
        'x': 1798,
        'z': -430,
        'y': 835
    }, {'name': 'Portal (S)', 'region': 22106, 'x': 1316, 'z': -432, 'y': 832}],
    'type': 0
}, {
    'name': 'Portal (S)',
    'region': 22106,
    'x': 1224,
    'z': -432,
    'y': 767,
    'teleport': [{'name': 'Portal (C)', 'region': 22618, 'x': 1287, 'z': -236, 'y': 36}, {
        'name': 'Portal (N)',
        'region': 22874,
        'x': 1798,
        'z': -430,
        'y': 835
    }, {'name': 'Portal (W)', 'region': 22617, 'x': 724, 'z': -431, 'y': 481}],
    'type': 0
}, {
    'name': 'Desert Rift',
    'region': 22101,
    'x': 846,
    'z': 0,
    'y': 293,
    'teleport': [{'name': 'Phantom Desert', 'region': 20815, 'x': 332, 'z': 229, 'y': 514}],
    'type': 0
}, {
    'name': 'Desert Rift',
    'region': 20815,
    'x': 230,
    'z': 255,
    'y': 546,
    'teleport': [{'name': 'Kirk Field', 'region': 22101, 'x': 750, 'z': 0, 'y': 300}],
    'type': 0
}, {
    'name': 'Hideout Portal',
    'region': 18769,
    'x': 1001,
    'z': -319,
    'y': 492,
    'teleport': [{'name': 'Kalia\'s Hideout', 'region': -32743, 'x': 0, 'z': 7, 'y': 360}],
    'type': 0
}, {
    'name': 'Reality Rift',
    'region': 23636,
    'x': 1589,
    'z': -430,
    'y': 1200,
    'teleport': [{'name': 'Village Old Man Kerim', 'region': 22106, 'x': 443, 'z': -432, 'y': 1529}],
    'type': 0
}, {
    'name': 'Reality Rift',
    'region': 23891,
    'x': 1012,
    'z': -236,
    'y': 606,
    'teleport': [{'name': 'Village Old Man Kerim', 'region': 22106, 'x': 443, 'z': -432, 'y': 1529}],
    'type': 0
}, {
    'name': 'Hideout Portal',
    'region': -32743,
    'x': 0,
    'z': 7,
    'y': 450,
    'teleport': [{'name': 'Phantom Desert', 'region': 18769, 'x': 961, 'z': -341, 'y': 574}],
    'type': 0
}, {
    'name': 'Gate of Constantinople Fortress (I)',
    'region': 25933,
    'x': 370,
    'z': -76,
    'y': 190,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 15451,
        'x': 1471,
        'z': 75,
        'y': 877
    }, {'name': 'Gate II of Fortress', 'region': 15963, 'x': 1174, 'z': 10, 'y': 1161}, {
        'name': 'Gate III of Fortress',
        'region': 16219,
        'x': 1009,
        'z': 40,
        'y': 747
    }],
    'type': 1
}, {
    'name': 'Gate of Fortress (I)',
    'region': 15451,
    'x': 1197,
    'z': 76,
    'y': 876,
    'teleport': [{
        'name': 'Gate of Constantinople Fortress',
        'region': 25933,
        'x': 252,
        'z': -80,
        'y': 181
    }, {
        'name': 'Gate II of Constantinople Fortress',
        'region': 26189,
        'x': 1,
        'z': -68,
        'y': 973
    }, {'name': 'Gate III of Constantinople Fortress', 'region': 25676, 'x': 1583, 'z': -62, 'y': 359}],
    'type': 1
}, {
    'name': 'Gate of Fortress (II)',
    'region': 15963,
    'x': 898,
    'z': 34,
    'y': 1155,
    'teleport': [{
        'name': 'Gate of Constantinople Fortress',
        'region': 25933,
        'x': 252,
        'z': -80,
        'y': 181
    }, {
        'name': 'Gate II of Constantinople Fortress',
        'region': 26189,
        'x': 1,
        'z': -68,
        'y': 973
    }, {'name': 'Gate III of Constantinople Fortress', 'region': 25676, 'x': 1583, 'z': -62, 'y': 359}],
    'type': 1
}, {
    'name': 'Gate of Fortress (III)',
    'region': 16219,
    'x': 737,
    'z': 58,
    'y': 758,
    'teleport': [{
        'name': 'Gate of Constantinople Fortress',
        'region': 25933,
        'x': 252,
        'z': -80,
        'y': 181
    }, {
        'name': 'Gate II of Constantinople Fortress',
        'region': 26189,
        'x': 1,
        'z': -68,
        'y': 973
    }, {'name': 'Gate III of Constantinople Fortress', 'region': 25676, 'x': 1583, 'z': -62, 'y': 359}],
    'type': 1
}, {
    'name': 'Gate of Charge',
    'region': 16222,
    'x': 1023,
    'z': 26,
    'y': 1247,
    'teleport': [{
        'name': 'Gate of Glory',
        'region': 15707,
        'x': 1207,
        'z': 102,
        'y': 849
    }, {'name': 'Gate of Resurrection', 'region': 15710, 'x': 1224, 'z': 0, 'y': 1132}],
    'type': 3
}, {
    'name': 'Gate of Glory',
    'region': 15707,
    'x': 913,
    'z': 116,
    'y': 842,
    'teleport': [{
        'name': 'Gate of Charge',
        'region': 16222,
        'x': 864,
        'z': -3,
        'y': 1026
    }, {'name': 'Gate of Resurrection', 'region': 15710, 'x': 1224, 'z': 0, 'y': 1132}],
    'type': 3
}, {
    'name': 'Gate of Resurrection',
    'region': 15710,
    'x': 1225,
    'z': 0,
    'y': 1031,
    'teleport': [{'name': 'Gate of Charge', 'region': 16222, 'x': 864, 'z': -3, 'y': 1026}, {
        'name': 'Gate of Glory',
        'region': 15707,
        'x': 1207,
        'z': 102,
        'y': 849
    }, {'name': 'Constantinople', 'region': 26959, 'x': 950, 'z': 84, 'y': 1070}],
    'type': 2
}, {
    'name': 'Gate of Constantinople Fortress (II)',
    'region': 26189,
    'x': 91,
    'z': -104,
    'y': 973,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 15451,
        'x': 1471,
        'z': 75,
        'y': 877
    }, {'name': 'Gate II of Fortress', 'region': 15963, 'x': 1174, 'z': 10, 'y': 1161}, {
        'name': 'Gate III of Fortress',
        'region': 16219,
        'x': 1009,
        'z': 40,
        'y': 747
    }],
    'type': 1
}, {
    'name': 'Gate of Constantinople Fortress (III)',
    'region': 25676,
    'x': 1609,
    'z': -37,
    'y': 134,
    'teleport': [{
        'name': 'Gate I of Fortress',
        'region': 15451,
        'x': 1471,
        'z': 75,
        'y': 877
    }, {'name': 'Gate II of Fortress', 'region': 15963, 'x': 1174, 'z': 10, 'y': 1161}, {
        'name': 'Gate III of Fortress',
        'region': 16219,
        'x': 1009,
        'z': 40,
        'y': 747
    }],
    'type': 1
}, {
    'name': 'GATE_DUMMY',
    'region': 25256,
    'x': 960,
    'z': 40,
    'y': 1205,
    'teleport': [{
        'name': 'GATE_HUNTER_SPAWN',
        'region': 32242,
        'x': 1243,
        'z': -1832,
        'y': 7
    }, {'name': 'GATE_THIEF_SPAWN', 'region': 31985, 'x': 507, 'z': -1832, 'y': 1902}],
    'type': 0
}, {
    'name': 'Mortifying Monk (Shambhala Entrance)',
    'region': 27011,
    'x': 1751,
    'z': 2,
    'y': 987,
    'teleport': [{
        'name': 'GATE_OTHER_SKYTEMPLE_A',
        'region': 25567,
        'x': 1295,
        'z': 40,
        'y': 1282
    }, {'name': 'GATE_OTHER_SKYTEMPLE_B', 'region': 25576, 'x': 1348, 'z': 50, 'y': 1339}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 25567,
    'x': 943,
    'z': 25,
    'y': 1694,
    'teleport': [{'name': 'Taklamakan', 'region': 27011, 'x': 1836, 'z': 10, 'y': 694}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 25576,
    'x': 919,
    'z': 25,
    'y': 1659,
    'teleport': [{'name': 'Taklamakan', 'region': 27011, 'x': 1836, 'z': 10, 'y': 694}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 23007,
    'x': 950,
    'z': 25,
    'y': 1685,
    'teleport': [{'name': 'Taklamakan', 'region': 27011, 'x': 1836, 'z': 10, 'y': 694}],
    'type': 0
}, {
    'name': 'Dimensional Rift',
    'region': 22246,
    'x': -19,
    'z': -40,
    'y': 1433,
    'teleport': [{'name': 'Taklamakan', 'region': 27011, 'x': 1836, 'z': 10, 'y': 694}],
    'type': 0
}, {
    'name': 'Thief Town',
    'region': -32767,
    'x': 1011,
    'z': 0,
    'y': -862,
    'teleport': [{'name': 'Thief Town', 'region': 27027, 'x': 1814, 'z': 452, 'y': 1834}],
    'type': 5
}, {
    'name': 'Thief Town',
    'region': 27027,
    'x': 1814,
    'z': 452,
    'y': 1834,
    'teleport': [{'name': 'Thief Town', 'region': -32767, 'x': 1011, 'z': 0, 'y': -862}],
    'type': 5
}, {
    'name': 'Qin-Shi Tomb',
    'region': 26284,
    'x': 960,
    'z': 111,
    'y': 1662,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.1', 'region': -32761, 'x': -1, 'z': -11, 'y': -3200}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.1',
    'region': -32761,
    'x': -1,
    'z': -11,
    'y': -3200,
    'teleport': [{'name': 'Qin-Shi Tomb', 'region': 26284, 'x': 960, 'z': 111, 'y': 1662}],
    'type': 5
}, {
    'name': 'Qin-Shi Tomb',
    'region': -32761,
    'x': 2,
    'z': 223,
    'y': 6495,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -13674, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -10468,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -8259, 'z': 0, 'y': 5592}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -13674,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Qin-Shi Tomb', 'region': -32761, 'x': 2, 'z': 223, 'y': 6495}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -3858,
    'z': 0,
    'y': 5592,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -1628, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -6068, 'z': 0, 'y': 1640}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -8259,
    'z': 0,
    'y': 5592,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -10468, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 12124, 'z': 0, 'y': 7228}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 4610, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 4580, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 6208, 'z': 0, 'y': 4035}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -5, 'z': 0, 'y': 2173}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -1628,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -3858, 'z': 0, 'y': 5592}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 7827,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 10497, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -3, 'z': 0, 'y': 7197}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 12124,
    'z': 0,
    'y': 4030,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 12124, 'z': 0, 'y': 1633}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 10497,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 7827, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 10496,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 7809, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 12124,
    'z': 0,
    'y': 1633,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 12124, 'z': 0, 'y': 4030}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 7809,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 10496, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 4580,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 2197, 'z': 0, 'y': -27}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 6208, 'z': 0, 'y': 4035}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 2197,
    'z': 0,
    'y': -27,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 4580, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -2203,
    'z': 0,
    'y': -27,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -4458, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -4458,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -2203, 'z': 0, 'y': -27}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -7704,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -10470, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -10470,
    'z': 0,
    'y': -21,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -7704, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -12072,
    'z': 0,
    'y': -1587,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -12072, 'z': 0, 'y': -3616}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -9871,
    'z': 0,
    'y': -5818,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -7684, 'z': 0, 'y': -5813}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -12072,
    'z': 0,
    'y': -3616,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -12072, 'z': 0, 'y': -1587}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -4458,
    'z': 0,
    'y': -5813,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -1593, 'z': 0, 'y': -5819}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -7684,
    'z': 0,
    'y': -5813,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -9871, 'z': 0, 'y': -5818}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -5, 'z': 0, 'y': -2223}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 4610, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 1569,
    'z': 0,
    'y': -5818,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 4581, 'z': 0, 'y': -5814}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -12073, 'z': 0, 'y': -8021}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -1593,
    'z': 0,
    'y': -5819,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -4458, 'z': 0, 'y': -5813}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': -1567,
    'z': 0,
    'y': -5817,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -3858, 'z': 0, 'y': 5592}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -6068, 'z': 0, 'y': -1593}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 12124, 'z': 0, 'y': -1587}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 7809,
    'z': 0,
    'y': -5814,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 9924, 'z': 0, 'y': -5821}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 4581,
    'z': 0,
    'y': -5814,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 1569, 'z': 0, 'y': -5818}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 14325,
    'z': 0,
    'y': -5818,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 16479, 'z': 0, 'y': -5815}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 9924,
    'z': 0,
    'y': -5821,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 7809, 'z': 0, 'y': -5814}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 19707,
    'z': 0,
    'y': -5814,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': 352, 'z': 72, 'y': 78}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 16479,
    'z': 0,
    'y': -5815,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 14325, 'z': 0, 'y': -5818}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 16480,
    'z': 0,
    'y': 5596,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 13727, 'z': 0, 'y': 5596}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -13804, 'z': 0, 'y': -27}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 13730, 'z': 0, 'y': -21}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.2',
    'region': -32762,
    'x': 0,
    'z': 0,
    'y': 0,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': -14275, 'z': 0, 'y': -5824}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.3',
    'region': -32763,
    'x': 352,
    'z': 72,
    'y': 78,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.2', 'region': -32762, 'x': 19707, 'z': 0, 'y': -5814}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.3',
    'region': -32763,
    'x': 19140,
    'z': 549,
    'y': 15784,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.4', 'region': -32764, 'x': 18267, 'z': -98, 'y': 14340}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.3',
    'region': -32763,
    'x': 15855,
    'z': 549,
    'y': -18952,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.4', 'region': -32764, 'x': 15463, 'z': -126, 'y': -19780}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.3',
    'region': -32763,
    'x': -19110,
    'z': 584,
    'y': -16170,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.4', 'region': -32764, 'x': -17850, 'z': -126, 'y': -14329}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.3',
    'region': -32763,
    'x': -15711,
    'z': 549,
    'y': 19794,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.4', 'region': -32764, 'x': -15043, 'z': -98, 'y': 19789}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.4',
    'region': -32764,
    'x': 18267,
    'z': -98,
    'y': 14340,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': 19140, 'z': 549, 'y': 15784}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.4',
    'region': -32764,
    'x': 15463,
    'z': -126,
    'y': -19780,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': 15855, 'z': 549, 'y': -18952}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.4',
    'region': -32764,
    'x': -17850,
    'z': -126,
    'y': -14329,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': -19110, 'z': 584, 'y': -16170}],
    'type': 5
}, {
    'name': 'Tomb of Qin-Shi Emperor lv.4',
    'region': -32764,
    'x': -15043,
    'z': -98,
    'y': 19789,
    'teleport': [{'name': 'Tomb of Qin-Shi Emperor lv.3', 'region': -32763, 'x': -15711, 'z': 549, 'y': 19794}],
    'type': 5
}, {
    'name': 'GATE_RC_ROC_GATE',
    'region': 26045,
    'x': 1027,
    'z': -41,
    'y': 822,
    'teleport': [{'name': 'Roc Mountain', 'region': 23406, 'x': 1382, 'z': 4056, 'y': 1558}],
    'type': 0
}, {
    'name': 'Temple',
    'region': -32752,
    'x': -4027,
    'z': 58,
    'y': -3717,
    'teleport': [{'name': 'Storm and cloud Desert', 'region': 22347, 'x': 965, 'z': 49, 'y': 423}],
    'type': 5
}, {
    'name': 'Temple',
    'region': -32752,
    'x': 4376,
    'z': 55,
    'y': 4707,
    'teleport': [{'name': 'Storm and cloud Desert', 'region': 21067, 'x': 815, 'z': 20, 'y': 574}],
    'type': 5
}];

for (let i = 0; i < TPs.length; i++) {
    html = '<b>' + TPs[i].name + '</b>';
    for (let j = 0; j < TPs[i].teleport.length; j++)
        html += '<br><a href="#" onclick="xSROMap.FlyView(' + TPs[i].teleport[j].x + ',' + TPs[i].teleport[j].y + ',' + TPs[i].teleport[j].z + ',' + TPs[i].teleport[j].region + ')">' + TPs[i].teleport[j].name + '</a>';
    xSROMap.AddTeleport(html, TPs[i].type, TPs[i].x, TPs[i].y, TPs[i].z, TPs[i].region);
}

// Coordinate search on click/enter
$('#search .input-group-append').click(function () {
    let value = $('#search input[type="text"]').val().toLowerCase();
    xSROMap.GoToPlayer(value);
});
$('#search input[type="text"]').keypress(function (e) {
    if (e.which == 13) {
        $("#search .input-group-append").click();
    }
});
