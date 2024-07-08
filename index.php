<?php
/**
 * The main template file.
 *
 * @package WordPress
 */
?>

<?php get_header(); ?>

<!-- Main Content Sections -->
<div class="container text-center my-4">
    <div class="image-text-container">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img-01.jpg'); ?>" alt="Image" class="img-fluid img-01-size mx-auto">
        <div class="image-text-overlay">
            <h1 class="my-3"><strong>Type faster</strong></h1>
            <h4 class="text-muted">Learn to type faster with <strong>TYPO SPRINT</strong> typing tutor. Take our typing lessons for free.</h4>
        </div>
    </div>
</div>

<!-- New Heading for DEMO as Button -->
<div class="container text-center">
    <a href="startBtn" class="btn btn-primary btn-lg demo-button"><strong>DEMO</strong></a>
</div>

<div class="container bg-dark text-white rounded typing-test">
    <div class="container">
        <div id="startBtn" title="start test">
            <i class="fa-solid fa-keyboard"></i>
        </div>
        <input type="text" name="user-input" id="userInput" value="" />
        <div class="test-config-result">
            <div class="test-config">
                <div class="config" id="config1">
                    <div class="button">
                        <input type="checkbox" id="punctuation" name="include-to-test" value="punctuation" />
                        <label for="punctuation"><i class="fa-solid fa-at"></i> punctuation</label>
                    </div>
                    <div class="button">
                        <input type="checkbox" id="numbers" name="include-to-test" value="numbers" />
                        <label for="numbers"><i class="fa-solid fa-hashtag"></i> numbers</label>
                    </div>
                </div>
                <div class="spelter"></div>
                <div class="config" id="config2">
                    <div class="button">
                        <input type="radio" id="time" name="test-by" value="time" checked />
                        <label for="time"><i class="fa-solid fa-clock"></i> time</label>
                    </div>
                    <div class="button">
                        <input type="radio" id="words" name="test-by" value="words" />
                        <label for="words"><i class="fa-solid fa-a"></i> words</label>
                    </div>
                    <div class="button">
                        <input type="radio" id="quote" name="test-by" value="quote" />
                        <label for="quote"><i class="fas fa-fw fa-quote-left"></i> quote</label>
                    </div>
                    <div class="button">
                        <input type="radio" id="zen" name="test-by" value="zen" />
                        <label for="zen"><i class="fas fa-fw fa-mountain"></i> zen</label>
                    </div>
                    <div class="button">
                        <input type="radio" id="custom" name="test-by" value="custom" />
                        <label for="custom"><i class="fas fa-fw fa-wrench"></i> custom</label>
                    </div>
                </div>
                <div class="spelter"></div>
                <div class="config" id="config3">
                    <div class="time-word-config">
                        <input type="radio" id="15" name="time-word-config" value="15" />
                        <label for="15">15</label>
                    </div>
                    <div class="time-word-config">
                        <input type="radio" id="30" name="time-word-config" value="30" />
                        <label for="30">30</label>
                    </div>
                    <div class="time-word-config">
                        <input type="radio" id="60" name="time-word-config" value="60" checked />
                        <label for="60">60</label>
                    </div>
                    <div class="time-word-config">
                        <input type="radio" id="100" name="time-word-config" value="100" />
                        <label for="100">120</label>
                    </div>
                </div>
                <div class="textButton" id="tools">
                    <i class="fas fa-fw fa-tools"></i>
                </div>
            </div>
        </div>
        <div id="testModesNotice">
            <div class="textButton" commands="languages">
                <i class="fas fa-globe-americas"> </i>
                english
            </div>
        </div>
        <div class="test-results">
            <div class="col">
                <div class="result big-text">
                    <span class="result-head">WPM</span>
                    <span class="result-value wpm">43</span>
                </div>

                <div class="result big-text">
                    <span class="result-head">acc</span>
                    <span class="result-value acc">96%</span>
                </div>
            </div>
            <div class="col">
                <div class="result">
                    <span class="result-head">test type</span>
                    <span class="result-value test-type"> </span>
                </div>
                <div class="result">
                    <span class="result-head">finished time</span>
                    <span class="result-value time">0:15</span>
                </div>
            </div>
        </div>
        <div class="typing-test">
            <div class="time-word-info"></div>
            <div class="test shadow">
                <div class="overlay">
                    <i class="fa-solid fa-arrow-pointer"></i>
                    Click here or press any key to focus
                </div>
                <div class="starting-text">
                    lipsum dolor sit amet consectetur adipisicing elit. Dolor ipsum
                    deserunt recusandae voluptatem accusamus quo quisquam cum, sunt,
                    ullam quos laudantium velit, at atque! Voluptates animi ratione
                    similique velit facilis.
                </div>
                <div class="test-text"></div>
            </div>
            <!-- <button id="restartTestButton" class="text">
                <i class="fas fa-fw fa-redo-alt"></i>
            </button> -->
        </div>
        <!-- <div id="commandLineMobileButton">
            <i class="fas fa-terminal"></i>
        </div> -->
        <div class="keyTips">
            <key>tab</key> + <key>enter</key> - restart test
            <br />
            <key>esc</key> or <key>ctrl</key> + <key>shift</key> + <key>p</key> -
            command line
        </div>
    </div>
    
    <!-- New separate div for the output -->
    <div class="output-space"></div>
</div>

<div class="container d-flex justify-content-center my-4">
    <div class="bg-info rounded shadow p-4 text-center">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-left">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/targy-dark.svg'); ?>" alt="Logo" class="img-fluid logo-size" style="width: 120px;">
            </div>
            <div class="col-md-6 text-md-right mb-3 mb-md-0">
                <button class="btn btn-outline-light btn-lg">Test Your Speed</button>
            </div>
        </div>
    </div>
</div>

<div class="container my-4 py-4 bg-light rounded d-flex justify-content-between align-items-center">
    <div class="flex-fill pr-4">
        <h1>Take a test and get your own certificate</h1>
        <h4 class="text-muted">Take an online typing test to find out your typing speed and impress friends or employers with your personal typing certificate.</h4>
        <a href="#" class="btn btn-success btn-lg">Get a Certificate</a>
    </div>
    <div class="flex-fill text-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/ms-lightning-dark.svg'); ?>" alt="Logo" class="img-fluid logo-size" style="width: 120px;">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img-02.jpg'); ?>" alt="Certificate Image" class="img-fluid rounded">
        </div>
    </div>
</div>

<div class="container my-4 py-4 bg-dark text-white rounded d-flex justify-content-between align-items-center">
    <div class="flex-fill text-center pr-4">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/ms-starky-dark.svg'); ?>" alt="Typing Image" class="img-fluid rounded">
    </div>
    <div class="flex-fill pl-4">
        <h1>Learn touch typing</h1>
        <h4 class="text-light">Speed up your learning progress with <strong>TYPO SPRINT</strong> typing tutor and develop valuable keyboarding skills!</h4>
        <a href="#" class="btn btn-outline-info">View Tips</a>
    </div>
</div>

<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/script1.js'); ?>"></script>
<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/app.js'); ?>" type="module"></script>
<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/test.js'); ?>" type="module"></script>

<?php get_footer(); ?>
