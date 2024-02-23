<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social and Ethical Considerations</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../footer/style.css" />
</head>
<body>
  <nav>
      <ul>
        <li><a class='title' href='../'>Crimson Flags</a></li>
        <li><a href="../login/login.php">Login</a></li>
      </ul>
    </nav>
    <main>
    <h1>Social and Ethical Considerations</h1>
    <h2>Introduction</h2>
    <p>When developing technology, it is imperative to recognize the relationship between technology and society. They both influence each other, and one does not exert dominance over the other. In regards to our planned roommate matching system, taking a technological determinism lens would be problematic because it would dismiss the undeniable role that humans, social roles, and biases play in technology development. The need for a more comprehensive and efficient roommate finding/matching system arose from the existing social ramifications of having a randomly assigned roommate or an unsatisfactory roommate. After all, if it weren’t for this pressing social issue, there would be no desire for a technological solution to begin with. The concept and implementation of our project would not have been possible without human and societal needs, demonstrating that technology does not hold all of the power. On the other hand, utilizing a perspective that places all of the power in society rather than technology is also problematic. Even though this project is derived from a desire to mitigate a social issue, technology is being used to determine someone’s future living situation. This has implications for their academic and personal well-being and can impact human behavior and feelings, indicating that technological changes can also lead to changes in social spheres. In addition, if our system does not function properly, it would impact humans. Ultimately, adopting a mutual shaping view of the system is crucial because it recognizes that technological and social changes both influence each other, especially since our system sits at the intersection of technology and society. In addition, our system will not be infallible. It could have flaws and lead to unintended consequences, but in order to improve our project for the future, it's important to take on the mutual shaping perspective to ensure a holistic view of the issue. Only when both the power of social context on technological development and the influence of technology on human behavior are taken into consideration will iteration and solution be possible. </p>
    <h2>Automation</h2>
    <p>Instead of people needing to actively search for potential matches, our system automates this by process by utilizing an algorithm to generate a list of matches for users. On many other roommate-finding apps, users spend hours and much of their energy scrolling through hundreds of users and examining hundreds of profiles. This is extremely draining for users, so we believe that this is the correct approach because our system is making that process more efficient, saving people a significant amount of time and effort. Users will be informed about this automation. Although It is implied in the purpose of the app, we will make the effort to be clear by explicitly stating in the quiz instructions that we are automating this process by utilizing an algorithm to compare their quiz answers to others’ answers in order to find matches. We also believe that informing users is the correct approach because there is no benefit to deceiving users or hiding this automation from users. If anything, we aim to gain users’ trust so that they are inclined to utilize our application.</p>
    <h2>Data</h2>
    <p>Our system will be collecting and storing personal information from users, including their first and last name, birthday, email, phone number, and a brief biography. However, we will not be sharing users’ contact information (email and phone number) publicly, and this information will not be displayed on their profiles. We recognize that contact information should only be shared with authorization and permission from users, as sharing such information could pose safety and security risks. This is why our system allows users to chat with and message others within our web application; Then, after becoming more familiar with each other, matched users are free to share their phone number if they desire. The only data we are collecting that is potentially sensitive is photos of student ID cards. We collect this information as a part of our verification feature, where users can upload proof of their status as a student or incoming student. Although users do not have to be verified to use the system, seeing that someone is verified provides a sense of protection and/or security. We believe it is necessary to collect this data, even if it is sensitive, to prioritize user safety and to have a safeguard against those with malicious intent (i.e., catfishes). We will not be collecting any financial information or other forms of sensitive data. In addition, in observance of the Indiana Social Security Number (SSN) disclosure law, which makes it a crime to disclose a person's SSN except under certain circumstances, we will not be collecting or storing users’ SSN. </p>
    </main>
    <?php 
  include("../footer/index.php");
  ?>
</body>
</html>