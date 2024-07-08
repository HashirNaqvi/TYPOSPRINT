const testConfiguration = document.querySelector(".test-config");

export let testConfig = {
  "include-to-test": [],
  "time-word-config": 60, // Fixed timer configuration
};

testConfiguration.addEventListener("change", handleTestConfigChange);
window.addEventListener("DOMContentLoaded", setUpTestConfigurationContainer);

function handleTestConfigChange(e) {
  const { name, value } = e.target;
  if (name === "include-to-test") {
    const checkBoxes = document.querySelectorAll(`input[name="${name}"]`);
    const checkedBoxesValue = [];

    for (let box of checkBoxes) {
      if (box.checked) {
        checkedBoxesValue.push(box.value);
      }
    }

    testConfig = { ...testConfig, [name]: checkedBoxesValue };
  }
  setUpTestConfigurationContainer();
}

function setUpTestConfigurationContainer() {
  const timeWordConfigs = document.querySelectorAll(".time-word-config");
  timeWordConfigs.forEach((elm) => elm.classList.add("time"));
}

const typingTest = document.querySelector(".typing-test");
const testContainer = document.querySelector(".test");
const testText = document.querySelector(".test-text");
const textOverlay = document.querySelector(".overlay");
const startingTextContainer = document.querySelector(".starting-text");
const testResult = document.querySelector(".test-results");
const testInfo = document.querySelector(".time-word-info");

const punctuation = `+",.-'"&!?:;#~=/$^()_<>`;
const letters = "abcdefghijklmnopqrstuvwxyz";
let testWords = [];
export let testLetters = [];

export function initTest() {
  testConfiguration.classList.add("hide");
  testResult.classList.remove("show");

  testInfo.innerHTML = "";
  testInfo.classList.remove("hide");

  testContainer.classList.remove("shadow");
  textOverlay.classList.add("hide");
  startingTextContainer.classList.add("hide");

  typingTest.classList.add("no-click");
  testWords = generateTestText();

  createWords();
  setTimer(testConfig["time-word-config"]); // Start the timer
}

function generateTestText() {
  const numberOfWords = 40; // Fixed number of words
  const includeToTest = testConfig["include-to-test"];
  const words = [];

  for (let i = 0; i < numberOfWords; i++) {
    let wordLength = random(8) + 1;
    let word = "";

    for (let j = 0; j < wordLength; j++) {
      let randomLetter = letters[random(letters.length)];
      if (random(8) === 4) {
        word += randomLetter.toLocaleUpperCase();
      } else {
        word += randomLetter;
      }
    }

    if (includeToTest.includes("punctuation")) {
      if (random(8) % 2 === 0) {
        word += punctuation[random(punctuation.length)];
      }
    }

    if (includeToTest.includes("numbers")) {
      if (random(8) % 2 === 0) {
        word += " " + random(10);
      }
    }

    words.push(word);
  }
  return words;
}

function createLetter(letter, parentContainer, i, j) {
  const letterSpan = document.createElement("span");
  letterSpan.innerText = letter;
  letterSpan.className = "letter";
  letterSpan.id = `${i}:${j}`;
  parentContainer.appendChild(letterSpan);
  testLetters.push(letterSpan);
}

function createWords() {
  for (let i = 0; i < testWords.length; i++) {
    const wordDiv = document.createElement("div");
    wordDiv.id = i + 1;
    wordDiv.className = "word";

    [...testWords[i]].forEach((letter, j) => {
      createLetter(letter, wordDiv, i + 1, j + 1);
    });

    if (i < testWords.length - 1) {
      createLetter(" ", wordDiv, i + 1, testWords[i].length + 1);
    }

    testText.appendChild(wordDiv);
  }
}

function setTimer(seconds) {
  testInfo.innerHTML = `${seconds}s`;
  let timeLeft = seconds;
  const timer = setInterval(() => {
    timeLeft--;
    testInfo.innerHTML = `${timeLeft}s`;
    if (timeLeft <= 0) {
      clearInterval(timer);
      showResult();
    }
  }, 1000);
}

function showResult() {
  stopDuration();

  const [WPM, accuracy] = calculateUserTestResult();
  const [minutes, seconds] = handleMinutesAndSeconds(duration);

  wordPerMinuteContainer.innerHTML = WPM;
  accContainer.innerHTML = `${accuracy}%`;
  timeInfoContainer.innerHTML = `${minutes}:${seconds}`;

  createTestTypeInfo();
  reInitTest();
  testResult.classList.add("show");
}

function calculateUserTestResult() {
  const avgEnglishWordLength = 5;
  const numberOfWrongWords = wrongLetters.length / avgEnglishWordLength;
  const numberOfCorrectWords = numberOfWords - Math.ceil(numberOfWrongWords);
  const acc = Math.floor((numberOfCorrectWords / numberOfWords) * 100);
  const wpm = Math.floor(numberOfCorrectWords / (duration / 60));

  const WPM = wpm >= 0 ? wpm : 0;
  const accuracy = acc >= 0 ? acc : 0;

  return [WPM, accuracy];
}

function createTestTypeInfo() {
  testTypeResultInfo.innerHTML = "";

  const testBySpan = document.createElement("span");
  testBySpan.innerHTML = `test by time`;
  testTypeResultInfo.appendChild(testBySpan);

  testConfig["include-to-test"].map((elm) => {
    const span = document.createElement("span");
    span.innerHTML = `include ${elm}`;
    testTypeResultInfo.appendChild(span);
  });

  const testTime = document.createElement("span");
  testTime.innerHTML = `chosen time 60s`;
  testTypeResultInfo.appendChild(testTime);
}

function stopDuration() {
  endDuration = Date.now();
  duration = parseInt((endDuration - startDuration) / 1000);
}

function reInitTest() {
  testText.innerHTML = "";
  testConfiguration.classList.remove("hide");

  testInfo.classList.add("hide");

  testContainer.classList.add("shadow");
  textOverlay.classList.remove("hide");
  startingTextContainer.classList.remove("hide");

  typingTest.classList.remove("no-click");
  currentIndex = 0;
  numberOfWords = 0;
  wrongLetters = [];
  resetTestWordsAndLetters();
  duration = 0;
  userInput.value = "";

  allowUserInput = false;
  userInputLetters = [];
  userInput.blur();

  testStarted = false;
}

function handleMinutesAndSeconds(numberOfSeconds) {
  let minutes = parseInt(numberOfSeconds / 60);
  let seconds = numberOfSeconds % 60;
  seconds = seconds > 9 ? seconds : `0${seconds}`;

  return [minutes, seconds];
}

function random(limit) {
  return Math.floor(Math.random() * limit);
}

export function resetTestWordsAndLetters(params) {
  testWords = [];
  testLetters = [];
}
