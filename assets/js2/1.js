import {
  initTest,
  resetTestWordsAndLetters,
  testLetters,
  testConfig,
} from "./test.js";
const { jsPDF } = window.jspdf;

const typingTest = document.querySelector(".typing-test");
const testContainer = document.querySelector(".test");
const testText = document.querySelector(".test-text");
const userInput = document.getElementById("userInput");
const testInfo = document.querySelector(".time-word-info");
const testResult = document.querySelector(".test-results");
const testConfiguration = document.querySelector(".test-config");
const startingTextContainer = document.querySelector(".starting-text");
const textOverlay = document.querySelector(".overlay");
const wordPerMinuteContainer = document.querySelector(".wpm");
const accContainer = document.querySelector(".acc");
const testTypeResultInfo = document.querySelector(".test-type");
const timeInfoContainer = document.querySelector(".time");
const startBtn = document.getElementById("startBtn");
const downloadBtn = document.createElement("button"); // Create download button

let currentIndex = 0;
let userInputLetters = [];
let wrongLetters = [];
let timer;
let startDuration, endDuration, duration;
let numberOfWords = 0;
let allowUserInput = true;
let testStarted = false;

// Button for downloading certificate
downloadBtn.innerText = "Download Certificate";
downloadBtn.addEventListener("click", downloadCertificate);

startBtn.addEventListener("click", () => {
  if (!testStarted) {
    typingTest.click();
  }

  testStarted = true;
  allowUserInput = true;
});

typingTest.addEventListener("click", () => {
  initTest();
  setUpUserInput();
  setDuration();

  testStarted = true;
  allowUserInput = true;
});

userInput.addEventListener("blur", () => allowUserInput && userInput.focus());

userInput.addEventListener("input", startTest);

function setUpUserInput() {
  userInput.focus();
  testLetters[currentIndex].classList.add("cursor");
  setTimer(testConfig["time-word-config"]); // Always use the fixed 60-second timer
}

function startTest() {
  if (currentIndex < testLetters.length - 1) {
    handleUserInput(this);
    updateNumberOfWords();
  } else {
    clearInterval(timer);
    showResult();
  }

  handleCursor();
}

function handleUserInput(input) {
  userInputLetters = input.value.split("");

  const userCurrentLetter = userInputLetters[currentIndex];
  const testCurrentLetter = testLetters[currentIndex].textContent;

  if (userCurrentLetter !== undefined) {
    if (userCurrentLetter === testCurrentLetter) {
      correctLetter();
    } else {
      wrongLetter();
    }
    currentIndex++;
  } else {
    currentIndex--;
    testLetters[currentIndex].className = "letter";
  }
}

function correctLetter() {
  if (!wrongLetters.includes(testLetters[currentIndex].id)) {
    testLetters[currentIndex].classList.add("correct");
  } else {
    if (testLetters[currentIndex].textContent !== " ") {
      testLetters[currentIndex].classList.add("updated");
    } else {
      testLetters[currentIndex].classList.add("updated-space");
    }
  }
}

function wrongLetter() {
  if (testLetters[currentIndex].textContent !== " ") {
    if (!wrongLetters.includes(testLetters[currentIndex])) {
      testLetters[currentIndex].classList.add("wrong");
    } else {
      testLetters[currentIndex].classList.add("updated");
    }
  } else {
    testLetters[currentIndex].classList.add("wrong-space");
  }

  wrongLetters.push(testLetters[currentIndex].id);
}

function handleCursor() {
  testLetters.map((elm) => elm.classList.remove("cursor"));
  testLetters[currentIndex]?.classList.add("cursor");
}

function updateNumberOfWords() {
  const currentWordNumber = testLetters[currentIndex].parentNode.id;
  numberOfWords = parseInt(currentWordNumber) - 1;
}

function setDuration() {
  startDuration = Date.now();
}

function stopDuration() {
  endDuration = Date.now();
  duration = parseInt((endDuration - startDuration) / 1000);
}

function showResult() {
  stopDuration();

  const [WPM, accuracy] = calculateUserTestResult();
  const [minutes, seconds] = handleMinutesAndSeconds(duration);

  wordPerMinuteContainer.innerHTML = WPM;
  accContainer.innerHTML = `${accuracy}%`;
  timeInfoContainer.innerHTML = `${minutes}:${seconds}`;

  createTestTypeInfo();
  if (WPM >= 40) {
    testResult.appendChild(downloadBtn); // Append the download button to the results
    displayCertificateLevel(WPM, accuracy); // Display the certificate level
  } else {
    testResult.innerHTML = "Try again or work hard to get a certificate.";
  }
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

function setTimer(seconds) {
  timer = setInterval(() => {
    let [numberOfMinutes, numberOfSeconds] = handleMinutesAndSeconds(seconds);
    testInfo.innerHTML = `${numberOfMinutes}:${numberOfSeconds}`;

    if (--seconds < 0) {
      clearInterval(timer);
      showResult();
    }
  }, 1000);
}

function handleMinutesAndSeconds(numberOfSeconds) {
  let minutes = parseInt(numberOfSeconds / 60);
  let seconds = numberOfSeconds % 60;
  seconds = seconds > 9 ? seconds : `0${seconds}`;

  return [minutes, seconds];
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

function displayCertificateLevel(WPM, accuracy) {
  let certificateLevel = "";
  if (WPM >= 60 && accuracy >= 95) {
    certificateLevel = "Platinum";
  } else if (WPM >= 50 && accuracy >= 80) {
    certificateLevel = "Gold";
  } else if (WPM >= 40 && accuracy >= 70) {
    certificateLevel = "Silver";
  }

  if (certificateLevel) {
    const levelInfo = document.createElement("p");
    levelInfo.innerText = `You achieved ${certificateLevel} level!`;
    testResult.appendChild(levelInfo);
  }
}

function downloadCertificate() {
  const WPM = parseInt(wordPerMinuteContainer.innerHTML);
  const accuracy = parseInt(accContainer.innerHTML);
  const time = timeInfoContainer.innerHTML;
  let certificateLevel = "";

  if (WPM >= 60 && accuracy >= 95) {
    certificateLevel = "Platinum";
  } else if (WPM >= 50 && accuracy >= 80) {
    certificateLevel = "Gold";
  } else if (WPM >= 40 && accuracy >= 70) {
    certificateLevel = "Silver";
  }

  if (!certificateLevel) return;

  const username = "User"; // Replace with actual username
  const websiteName = "WP Gamechangers";
  const teamName = "WP Gamechangers Team";

  const pdf = new jsPDF();
  pdf.setFontSize(20);
  pdf.text("Certificate of Achievement", 20, 30);
  pdf.setFontSize(16);
  pdf.text(`This is to certify that ${username}`, 20, 50);
  pdf.text(`achieved ${certificateLevel} level in the typing test.`, 20, 60);
  pdf.text(`Typing Speed: ${WPM} WPM`, 20, 70);
  pdf.text(`Accuracy: ${accuracy}%`, 20, 80);
  pdf.text(`Time: ${time}`, 20, 90);
  pdf.text(`Website: ${websiteName}`, 20, 100);
  pdf.text(`Team: ${teamName}`, 20, 110);

  pdf.save("Certificate.pdf");
}

import { jsPDF } from "jspdf";

function downloadCertificate(username, WPM, accuracy, certificateLevel) {
  const pdf = new jsPDF();

  // Add Background Color
  pdf.setFillColor(255, 228, 225); // Light pink background
  pdf.rect(0, 0, 210, 297, "F"); // Full page rectangle

  // Certificate Border
  pdf.setLineWidth(1.5);
  pdf.setDrawColor(0, 0, 0); // Black border
  pdf.rect(10, 10, 190, 277);

  // Title
  pdf.setFontSize(30);
  pdf.setTextColor(0, 0, 128); // Dark blue title
  pdf.text("Certificate of Achievement", 105, 50, null, null, "center");

  // Subtitle
  pdf.setFontSize(16);
  pdf.setTextColor(0, 0, 0); // Black subtitle
  pdf.text(`This is to certify that`, 105, 80, null, null, "center");

  // Username
  pdf.setFontSize(24);
  pdf.setTextColor(0, 102, 204); // Blue username
  pdf.text(username, 105, 100, null, null, "center");

  // Certificate Level
  pdf.setFontSize(20);
  pdf.setTextColor(0, 0, 0); // Black text
  pdf.text(
    `has achieved ${certificateLevel} level`,
    105,
    120,
    null,
    null,
    "center"
  );

  // Details
  pdf.setFontSize(16);
  pdf.text(`Typing Speed: ${WPM} WPM`, 105, 140, null, null, "center");
  pdf.text(`Accuracy: ${accuracy}%`, 105, 155, null, null, "center");

  // Footer
  pdf.setFontSize(14);
  pdf.text(`Website: WP Gamechangers`, 105, 180, null, null, "center");
  pdf.text(`Team: WP Gamechangers Team`, 105, 195, null, null, "center");

  // Issue Date
  const issueDate = new Date().toLocaleDateString();
  pdf.setFontSize(12);
  pdf.text(`Issued on: ${issueDate}`, 105, 250, null, null, "center");

  pdf.save("Certificate.pdf");
}
