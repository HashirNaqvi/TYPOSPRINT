<?php
get_header();
?>

<div class="container">
      <!-- <div id="startBtn" title="start test">
        <i class="fa-solid fa-keyboard"></i>
      </div> -->
      <input type="text" name="user-input" id="userInput" value="" />

      <main>
        <div class="test-config-result">
          <div class="test-config">
            <div class="config" id="config1">
              <div class="button">
                <input
                  type="checkbox"
                  id="punctuation"
                  name="include-to-test"
                  value="punctuation"
                />
                <label for="punctuation"
                  ><i class="fa-solid fa-at"></i> punctuation</label
                >
              </div>
              <div class="button">
                <input
                  type="checkbox"
                  id="numbers"
                  name="include-to-test"
                  value="numbers"
                />
                <label for="numbers"
                  ><i class="fa-solid fa-hashtag"></i> numbers</label
                >
              </div>
            </div>
            <div class="spelter"></div>
            <div class="config" id="config2">
              <div class="button">
                <input
                  type="radio"
                  id="time"
                  name="test-by"
                  value="time"
                  checked
                />
                <label for="time"><i class="fa-solid fa-clock"></i> time</label>
              </div>
              <div class="button">
                <input type="radio" id="words" name="test-by" value="words" />
                <label for="words"><i class="fa-solid fa-a"></i> words</label>
              </div>
              <div class="button">
                <input type="radio" id="quote" name="test-by" value="quote" />
                <label for="quote"
                  ><i class="fas fa-fw fa-quote-left"></i> quote</label
                >
              </div>
              <div class="button">
                <input type="radio" id="zen" name="test-by" value="zen" />
                <label for="zen"
                  ><i class="fas fa-fw fa-mountain"></i> zen</label
                >
              </div>
              <div class="button">
                <input type="radio" id="custom" name="test-by" value="custom" />
                <label for="custom"
                  ><i class="fas fa-fw fa-wrench"></i> custom</label
                >
              </div>
            </div>
            <div class="spelter"></div>
            <div class="config" id="config3">
              <div class="time-word-config">
                <input
                  type="radio"
                  id="15"
                  name="time-word-config"
                  value="15"
                />
                <label for="15">15</label>
              </div>
              <div class="time-word-config">
                <input
                  type="radio"
                  id="30"
                  name="time-word-config"
                  value="30"
                />
                <label for="30">30</label>
              </div>
              <div class="time-word-config">
                <input
                  type="radio"
                  id="60"
                  name="time-word-config"
                  value="60"
                  checked
                />
                <label for="60">60</label>
              </div>
              <div class="time-word-config">
                <input
                  type="radio"
                  id="100"
                  name="time-word-config"
                  value="100"
                />
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
            <div id="startBtn" title="start test">
              <i class="fa-solid fa-keyboard"></i>
            </div>
          </div>
        </div>
        <div class="typing-test">
          <div class="time-word-info"></div>
          <div class="test shadow">
            <div class="overlay">
              <i class="fa-solid fa-arrow-pointer"></i>
              Click here to start the Test
            </div>
            <div class="starting-text">
              lipsum dolor sit amet consectetur adipisicing elit. Dolor ipsum
              deserunt recusandae voluptatem accusamus quo quisquam cum, sunt,
              ullam quos laudantium velit, at atque! Voluptates animi ratione
              similique velit facilis.
            </div>
            <div class="test-text"></div>
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
      </main>
      <!-- <div class="keyTips">
        <key>tab</key> + <key>enter</key> - restart test
        <br />
        <key>esc</key> or <key>ctrl</key> + <key>shift</key> + <key>p</key> -
        command line
      </div> -->
    </div>
    <script src="<?php echo get_template_directory_uri();?>/assets/js2/2.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/assets/js2/1.js" type="module"></script>
    <script src="<?php echo get_template_directory_uri();?>/assets/js2/3.js" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<?php
get_footer();
?>
