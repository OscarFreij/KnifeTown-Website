function setLanguage(languageCode) {
    document.cookie = "language="+languageCode;
}

function getLanguage() {
    console.log("current cookies: "+document.cookie);
}