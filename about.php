<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="css/about.css">

        <link rel="manifest" href="manifest.json">

        <title>About us</title>
    </head>
    <body onload="document.getElementsByTagName('button')[0].click()">
                <!-- Header -->
                <h1 class="h1Header">About Us</h1>

                <!-- Button Container -->
                <div class="row btnContainer">
                    <div class="tab">
                        <div class="row">
                            <div class="col-1 col-md">
                                <!-- Spacer -->
                            </div>
                            <div class="col-lg-2 col-md-auto">
                                <button class="tablinks" onclick="openTab(event, 'whoaW')">Who are we?</button>
                            </div>

                            <div class="col-lg-2 col-md-auto">
                                <button class="tablinks" onclick="openTab(event, 'wiTensai')">TENSAI</button>
                            </div>

                            <div class="col-lg-2 col-md-auto">
                                <button class="tablinks" onclick="openTab(event, 'mtTeam')">The Team</button>
                            </div>

                            <div class="col-lg-2 col-md-auto">
                                <button class="tablinks" onclick="openTab(event, 'faQuestions')">FAQs</button>
                            </div>
                            <div class="col-lg-2 col-md-auto">
                                <button class="tablinks" onclick="window.open('./', '_blank')">Get Started</button>
                                <!-- <button class="tablinks" onclick="window.open('https://tensaiedu.online', '_blank')">Get Started</button> -->
                            </div>
                            <div class="col-lg-1 col-md-auto">
                                <!-- Spacer -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Container -->
                <div class="row infoContainer">
                    <div class="col-12">
                        <!-- Who are we content -->
                        <div id="whoaW" class="tabcontent fade-in-fwd">
                            <div class="row">
                                <div class="col-lg-6 col-lg-auto">
                                    <!-- Video - left side -->
                                    <video class="videoInfo" controls>
                                    <source src="src/About/kid-globe.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="col-lg-6 col-lg-auto">
                                    <h2>Vision</h2>
                                    <br/>
                                    <p class="wawP">
                                        A leading e-learning web application assigned to the majority of schools that efficiently provide a better
                                        interactive learning environment of the Science subject aside from face to face classes by 20xx.
                                    </p>
                                    <h2>Mission</h2>
                                    <br/>
                                    <p class="wawP">
                                        To educate children with the better alternative from the traditional delivery of lessons and assessments
                                        whilst maintaining the efficiency, effectivity and social norms and etiquettes of learning.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- What is TENSAI content -->
                        <div id="wiTensai" class="tabcontent fade-in-fwd">
                            <div class="row">
                                <div class="col-12">
                                    <h1>TENSAI</h1>
                                    <h3 style="text-align: center;">An Interactive E-learning Progressive Web Application in Science for Grade 1 Students with Voice Controlled Assistant</h3>

                                    <br/>

                                    <p class="witP">
                                        The main objective of the study is to develop TENSAI: An Interactive E-Learning Progressive Web Application in Science for Grade 1 Students with Voice Controlled Assistant
                                        that will increase the interest of the students to study the Science subject in a suitable learning environment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Meet the Team content -->
                        <div id="mtTeam" class="tabcontent fade-in-fwd">
                            <div class="row">
                                <div class="wrapper cols">
                                    <div class="col-lg-auto col-md-auto col-sm-auto" ontouchstart="this.classList.toggle('hover');">
                                        <div class="container">
                                            <div class="front" style="background-image: url(src/About/bend.jpg)">
                                                <div class="inner">
                                                <p>Roque Danielle B. Perez</p>
                                                <span>Backend Developer</span>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="inner">
                                                        <img class="imgTeam" src="src/About/roks.webp">
                                                        <p class="txtTeam">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                                            esse cillum dolore eu fugiat nulla pariatur.
                                                        </p->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-auto  col-md-auto col-sm-auto" ontouchstart="this.classList.toggle('hover');">
                                        <div class="container">
                                            <div class="front" style="background-image: url(src/About/fend.jpg)">
                                                <div class="inner">
                                                <p>Andrea Theresse B. Jumpalad</p>
                                                <span>Frontend Developer</span>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="inner">
                                                    <img class="imgTeam" src="src/About/deng.jpg">
                                                    <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                                    esse cillum dolore eu fugiat nulla pariatur.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-auto  col-md-auto col-sm-auto" ontouchstart="this.classList.toggle('hover');">
                                        <div class="container">
                                            <div class="front" style="background-image: url(src/About/dox.jpg)">
                                                <div class="inner">
                                                <p>Mark Julius A. Trajano</p>
                                                <span>Documentation</span>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="inner">
                                                    <img class="imgTeam" src="src/About/ju.jpg">
                                                    <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                                    esse cillum dolore eu fugiat nulla pariatur.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-auto  col-md-auto col-sm-auto" ontouchstart="this.classList.toggle('hover');">
                                        <div class="container">
                                            <div class="front" style="background-image: url(src/About/ai.jpg)">
                                                <div class="inner">
                                                <p>Khenry John O. Perez</p>
                                                <span>AI Developer</span>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="inner">
                                                    <img class="imgTeam" src="src/About/ken.jpg">
                                                    <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                                    esse cillum dolore eu fugiat nulla pariatur.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQs content -->
                        <div id="faQuestions" class="tabcontent fade-in-fwd">
                            <div class="row">
                                <div class="col-12">
                                    <h4>What is TENSAI?</h4>
                                        <p class="faqP">
                                            Tensai is an interactive e-learning web application designed to deliver learning for
                                            elementary students, Grade one students to be exact, focused on the Science subject.
                                        </p>
                                    <h4>What is RINA?</h4>
                                        <p class="faqP">
                                            RINA or RatIoNalized Assistant is TENSAI's very own virtual assistant. It constantly listens
                                            for commands from the users. It is equipped with speech recognition and text to speech
                                            technologies.
                                        </p>
                                    <h4>Who are the target users?</h4>
                                        <p class="faqP">
                                            The target users of this system are grade one students from elementarty schools.
                                        </p>
                                    <h4>How do I use TENSAI?</h4>
                                        <p class="faqP">
                                            EYou can access TENSAI via tensaiedu.online then login your account that was assigned to you
                                            by your educators.
                                        </p>
                                    <h4>How do I use RINA?</h4>
                                        <p class="faqP">
                                            Once your webpage loads up, our system will ask several permissions from you in order to use
                                            your microphone and speaker. Once granted, you may use RINA in two different way; The first one
                                            is to simply say "Hello Rina" and RINA will answer back by displaying its' speech bubble and
                                            prompted text-to-speech output. The second one would be to timply click RINA's icon located at
                                            the bottom right portion of your screen.
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Footer -->
        <footer>
            <p>
                Author: Group 5 &copy;2022
                <a href="mailto:tensaimailer@gmail.com">TENSAI</a>
            </p>
        </footer>

        <!-- BG Video -->
        <video autoplay muted loop class="bgVideo">
            <source src="src/About/kids.mp4" type="video/mp4">
        </video>

        <!-- Script Link -->
        <script src="javascript/about.js"></script>
    </body>
</html>