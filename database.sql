--User Table
CREATE TABLE user(
    userID INT NOT NULL AUTO_INCREMENT,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    major VARCHAR(50) NOT NULL,
    bio TINYTEXT NOT NULL,
    profilePicture VARCHAR(50) NOT NULL,
    PRIMARY KEY(userID)
) ENGINE = INNODB;
--admin table
-- CREATE TABLE admin(
--     adminID INT NOT NULL,
--     adminSince DATE,
--     FOREIGN KEY(adminID) REFERENCES user(userID)
-- ) ENGINE = INNODB;
--Verification table
CREATE TABLE verification(
    verificationID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    description TINYTEXT NOT NULL,
    proofOfIdentity VARCHAR(50) NOT NULL,
    PRIMARY KEY(verificationID),
    FOREIGN KEY(userID) REFERENCES user(userID)
) ENGINE = INNODB;
--Question table
CREATE TABLE question(
    questionID INT NOT NULL AUTO_INCREMENT,
    tierNumber INT(1),
    question VARCHAR(100) NOT NULL,
    answerChoice1 VARCHAR(50),
    answerChoice2 VARCHAR(50),
    answerChoice3 VARCHAR(50),
    answerChoice4 VARCHAR(50),
    answerChoice5 VARCHAR(50),
    PRIMARY KEY(questionID)
) ENGINE = INNODB;
--Answer choices table
CREATE TABLE answer(
    answerID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    userAnswer VARCHAR(50),
    questionID INT NOT NULL,
    PRIMARY KEY(answerID),
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(questionID) REFERENCES question(questionID)
) ENGINE = INNODB;
--Notification table
CREATE TABLE notification(
    notificationID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    notificationType VARCHAR(50) NOT NULL,
    notficationMsg TINYTEXT NOT NULL,
    PRIMARY KEY(notificationID),
    FOREIGN KEY(userID) REFERENCES user(userID)
) ENGINE = INNODB;
--matches table
CREATE TABLE matches(
    matchID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    matchUser INT NOT NULL,
    PRIMARY KEY(matchID),
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(matchUser) REFERENCES user(userID)
) ENGINE = INNODB;
--message table
CREATE TABLE messages(
    messageID INT NOT NULL AUTO_INCREMENT,
    sender INT NOT NULL,
    receiver INT NOT NULL,
    receiveTime DATETIME NOT NULL,
    messageText TINYTEXT NOT NULL,
    PRIMARY KEY(messageID),
    FOREIGN KEY(sender) REFERENCES user(userID),
    FOREIGN KEY(receiver) REFERENCES user(userID)
) ENGINE = INNODB;
--reviews table
CREATE TABLE reviews(
    reviewID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    reviewedUserID INT NOT NULL,
    reviewDesc VARCHAR(255) NOT NULL,
    PRIMARY KEY(reviewID),
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(reviewedUserID) REFERENCES user(userID)
) ENGINE = INNODB;
--reports table
CREATE TABLE reports(
    reportID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    reportedUserID INT NOT NULL,
    reasonForReport VARCHAR(50) NOT NULL,
    PRIMARY KEY(reportID),
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(reportedUserID) REFERENCES user(userID)
) ENGINE = INNODB;
--block
CREATE TABLE block(
    blockID INT NOT NULL AUTO_INCREMENT,
    userID INT NOT NULL,
    blockedUserID INT NOT NULL,
    PRIMARY KEY(blockID),
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(blockedUserID) REFERENCES user(userID)
) ENGINE = INNODB;
--map pins
CREATE TABLE map(
    pinID INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(75) NOT NULL,
    address VARCHAR(100) NOT NULL,
    lat FLOAT(10, 6) NOT NULL,
    lon FLOAT(10, 6) NOT NULL,
    link LONGTEXT NOT NULL,
    PRIMARY KEY(pinID)
) ENGINE = INNODB;
--Insert tables below
INSERT INTO map (pinID, name, address, lat, lon, link)
VALUES (
        1,
        'Wells Library',
        '1320 E 10th St, Bloomington, IN 47405',
        39.17145450292135,
        -86.5165343445002,
        'https://libraries.indiana.edu/herman-b-wells-library'
    ),
    (
        2,
        'Teter Quad',
        '501 N Sunrise Dr #7506, Bloomington, IN 47406',
        39.17055045221205,
        -86.51299261250543,
        'https://housing.indiana.edu/housing/locations/central/Teter/index.html'
    ),
    (
        3,
        'Forest Quad',
        '1725 E 3rd St, Bloomington, IN 47406',
        39.16480453245347,
        -86.51296195984291,
        'https://housing.indiana.edu/housing/locations/southeast/Forest/index.html'
    ),
    (
        4,
        'Briscoe Quad',
        '1225 N Fee Ln, Bloomington, IN 47406',
        39.178412649509,
        -86.51969511666071,
        'https://housing.indiana.edu/housing/locations/northwest/Briscoe/index.html'
    ),
    (
        5,
        'Tulip Tree',
        '2451 E 10th St, Bloomington, IN 47408',
        39.17257715454589,
        -86.50435041481134,
        'https://housing.indiana.edu/housing/locations/northeast/Tulip_Tree/index.html'
    ),
    (
        6,
        '3rd & Union',
        '290 S Union St, Bloomington, IN 47401',
        39.164652011502724,
        -86.50980967672854,
        'https://housing.indiana.edu/housing/locations/southeast/3rdandunion/index.html'
    ),
    (
        7,
        'Evolve Bloomington',
        '1425 N Dunn St, Bloomington, IN 47408',
        39.180134978277046,
        -86.5292524444999,
        'https://www.googleadservices.com/pagead/aclk?sa=L&ai=CLChl5sNUYoLBAsjcvdMP14ug-A_a1unHac2BvLjaDq2E-sDQDQgAEAEguVRgyeamiPSjwBCgAbOgspgoyAEByAPYIKoEW0_QMe57ISiTeaKC06nNB1zJXTQbSBeqMcxtVqlhpIDKFJkdOCRHs48pMtFx8RtsNHKzmjlxszMe6tfVnPkeCu6pTpVOgDe67QYRkkJT5Ume_GyVOfMrhMExy4DABMiZ9r33A4AFkE6IBZyO_M43oAZRgAez2IL4AogHAZAHAagHpr4bqAe5mrECqAfz0RuoB-7SG6gH_5yxAqgHytwbqAfNo7ECoAiriT6wCAHSCAwQAiCEATICgkA6AQCaCSJodHRwczovL3d3dy5ldm9sdmVibG9vbWluZ3Rvbi5jb20vsQnzWz6QQBEF6bkJ81s-kEARBen4CQGYCwGqDAIIAbgMAegMBoIUFggDEhJldm9sdmUgYmxvb21pbmd0b26IFALQFQH4FgGAFwGSFwkSBwgBEAMYsAE&ae=2&ved=2ahUKEwjc9qrRno33AhXBXM0KHTMGCiMQ0Qx6BAgiEAE&dct=1&cid=CAASFeRonyC6a4llnzo_mGXNvI8W7hIfFg&dblrd=1&sival=AF15MED0-86zIqJkWF8ipr9yzXXvhX0Kp9gOS-hbIgF6TBULYiZHIQAekmUF36OZWWgEB9fia64Pq3xbX0CZjpIhUJt7dqy_JPOoqT0XXXTQw1E_sLwztacrMlBpNPsZbFcBef0t-FP7y1HwZf_1_yThMpQbEZXe7iss6eXvnQdnttecye6DBZNAeJvNB8RSpreAc0UD7QIH&sig=AOD64_18OpBG20vzIVEfcqXYJwgNWIoMkg&adurl=https://www.evolvebloomington.com/'
    ),
    (
        8,
        'Eastbay Apartments',
        '2539 Eastgate Ln, Bloomington, IN 47408',
        39.17006411379173,
        -86.50093895898961,
        'https://www.tenthandcollege.com/iu-bloomington-campus-apartments-for-rent/east-bay/'
    ),
    (
        9,
        'Burnham Rentals',
        '444 E 3rd St #1, Bloomington, IN 47401',
        39.165007126778065,
        -86.5283041079447,
        'https://burnhamrentals.com'
    ),
    (
        10,
        'State On Campus Bloomington',
        '2036 N Walnut St, Bloomington, IN 47404',
        39.18555610841096,
        -86.5329412306851,
        'https://stateoncampus.com/bloomington/?utm_source=GoogleMyBusiness&utm_medium=organic&utm_campaign=GMB'
    ),
    (
        11,
        'Tenth & College',
        '601 N College Ave #1A, Bloomington, IN 47404',
        39.17270440168376,
        -86.53523347671275,
        'https://www.tenthandcollege.com'
    ),
    (
        12,
        'Ashton Redisent Center',
        '1800 E 10th St, Bloomington, IN 47405',
        39.17052258881439,
        -86.5122927729672,
        'https://housing.indiana.edu/housing/locations/central/Ashton/index.html'
    ),
    (
        13,
        'Collins LLC',
        '541 N Woodlawn Ave, Bloomington, IN 47408',
        39.170919383211114,
        -86.52371863558238,
        'https://collins.indiana.edu/index.html'
    ),
    (
        14,
        'Eigenmann Hall',
        '1900 E 10th St, Bloomington, IN 47408',
        39.17097699559394,
        -86.50837486441763,
        'https://housing.indiana.edu/housing/locations/central/Eigenmann/index.html'
    ),
    (
        15,
        'Hillcrest Apartments',
        'Cedar Hall, 445 N Union St, Bloomington, IN 47406',
        39.170747792057284,
        -86.50969362459732,
        'https://housing.indiana.edu/housing/locations/central/Hillcrest/index.html'
    ),
    (
        16,
        'Union Street Center',
        '1900 E 10th St, Bloomington, IN 47408',
        39.17097699559394,
        -86.50837486441763,
        'https://housing.indiana.edu/housing/locations/central/USC/index.html'
    ),
    (
        17,
        'Wright Quad',
        '501 N Jordan Ave, Bloomington, IN 47406',
        39.17064709386877,
        -86.51424395712596,
        'https://housing.indiana.edu/housing/locations/central/Wright/index.html'
    ),
    (
        18,
        'Campus View Apartments',
        '800 N Union St, Bloomington, IN 47408',
        39.173708730072725,
        -86.50896362024142,
        'https://housing.indiana.edu/housing/locations/northeast/Campus_View/index.html'
    ),
    (
        19,
        'Foster Quad',
        '1000 N Fee Ln #7501, Bloomington, IN 47406',
        39.175241836391066,
        -86.51817599680211,
        'https://housing.indiana.edu/housing/locations/northwest/Foster/index.html'
    ),
    (
        20,
        'McNutt Quad',
        '1101 N Fee Ln #7502, Bloomington, IN 47406',
        39.176431889835555,
        -86.52015334907666,
        'https://housing.indiana.edu/housing/locations/northwest/McNutt/index.html'
    );
--Adding username column in user table
ALTER TABLE user
ADD userName VARCHAR(100) NOT NULL;