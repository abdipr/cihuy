<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qur'an Cihuy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <style>
        h2 {
            color: var(--color-2);
        }

        @font-face {
            font-family: 'OmarFont';
            src: url('https://raw.githubusercontent.com/abdipr/cihuy/refs/heads/main/assets/omar.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }


        .header {
            position: sticky;
            top: 0;
            background: #222;
            color: #fff;
            padding: 10px 10px;
            font-weight: bold;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container p#surah-info {
            padding: 0;
            margin: 0;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #222;
            margin: 0;
        }

        #surah-arab {
            font-family: 'OmarFont', serif;
            font-size: 1.4em;
            font-weight: 200;
            transition: color 0.3s ease;
        }

        .ayat {
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .ayat-arab {
            font-family: 'OmarFont', serif;
            font-size: 2.8em;
            text-align: right;
            color: #444;
            margin: 0;
        }

        .ayat-transliteration {
            font-size: 0.85em;
            color: var(--color-3);
            margin-top: 5px;
            font-style: italic;
        }

        .ayat-translation {
            font-size: 1em;
            color: #666;
            margin-top: 5px;
        }

        .ayat-symbol {
            font-size: 1em;
            color: var(--color-3);
            margin-left: 5px;
            vertical-align: middle;
        }

        .toggle-btn {
            cursor: pointer;
            background: none;
            border: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .toggle-btn svg {
            width: 20px;
            height: 20px;
            fill: var(--color-1);
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .navigation-btn {
            text-align: center;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn {
            all: unset;
            font-family: inherit: display: inline-block;
            padding: 10px 20px;
            background: var(--color-1);
            color: #222;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: var(--color-2);
        }

        .btn:not(:disabled):hover {
            background: var(--color-2);
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        body.dark-mode .container {
            background: #333;
        }

        body.dark-mode h1,
        body.dark-mode p.ayat-arab {
            color: var(--dark-text);
        }

        body.dark-mode p#surah-info,
        body.dark-mode p.ayat-translation {
            color: var(--dark-text-1);
        }

        body.dark-mode .ayat-symbol,
        body.dark-mode .ayat-transliteration {
            color: var(--color-1);
        }
    </style>
</head>

<body>
    <?php include "header.php";?>
        <div class="container">
            <div class="navigation-btn">
                <button class="btn" id="prev-button" disabled>Sebelumnya</button>
                <button class="btn" id="next-button" disabled>Berikutnya</button>
            </div>
            <h1 id="surah-title"></h1>
            <p id="surah-info">Loading...</p>
            <div id="ayat-container"></div>
        </div>

        <script src="/script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const header = document.querySelector('.header');
                const titleElement = document.getElementById('surah-title');
                const infoElement = document.getElementById('surah-info');
                const ayatContainer = document.getElementById('ayat-container');
                let lastScrollY = 0;

                window.addEventListener('scroll', () => {
                    if (window.scrollY > lastScrollY) {
                        header.style.transform = 'translateY(-100%)';
                    } else {
                        header.style.transform = 'translateY(0)';
                    }
                    lastScrollY = window.scrollY;
                });

                const urlSegments = window.location.pathname.split('/');
                if (urlSegments.length < 4 || urlSegments[2] !== 'surah') {
                    infoElement.textContent = "Error: URL tidak valid. Gunakan format /quran/surah/{nomor surah}.";
                    return;
                }

                const surahNumber = parseInt(urlSegments[3]);

                const localData = localStorage.getItem(`surah_${surahNumber}`);
                if (localData) {
                    const surahData = JSON.parse(localData);
                    updateSurahContent(surahData);
                } else {
                    fetchSurahData(surahNumber);
                }

                function fetchSurahData(surahNumber) {
                    const apiUrl = `https://api.quran.gading.dev/surah/${surahNumber}`;
                    fetch(apiUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Tidak dapat mengakses API");
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.code !== 200) {
                                throw new Error("Tidak dapat menemukan surah.");
                            }
                            const surahData = data.data;
                            localStorage.setItem(`surah_${surahNumber}`, JSON.stringify(surahData));
                            updateSurahContent(surahData);
                        })
                        .catch(error => {
                            infoElement.textContent = `Error: ${error.message}`;
                        });
                }

                function updateSurahContent(surahData) {
                    document.title = `${surahData.name.transliteration.id} - Qur'an Cihuy`;
                    document.getElementById('title').innerText = `${surahData.name.transliteration.id}`;

                    titleElement.innerHTML = `${surahData.name.transliteration.id} <font id="surah-arab">(${surahData.name.short})</font>`;
                    infoElement.textContent = `${surahData.revelation.id} ・ ${surahData.numberOfVerses} ayat`;

                    surahData.verses.forEach((verse, index) => {
                        const verseElement = document.createElement('div');
                        verseElement.classList.add('ayat');

                        const arabicElement = document.createElement('p');
                        arabicElement.classList.add('ayat-arab');
                        const arabicNumber = `۝${convertToArabicNumber(index + 1)}`;
                        arabicElement.innerHTML = `${verse.text.arab} <span class="ayat-symbol">${arabicNumber}</span>`;

                        const transliterationElement = document.createElement('p');
                        transliterationElement.classList.add('ayat-transliteration');
                        const transliteration = verse.text.transliteration.en;
                        const adjustedTransliteration = transliteration.replace(/oo/g, 'uu').replace(/ee/g, 'ii').toLowerCase();
                        transliterationElement.textContent = adjustedTransliteration;

                        const translationElement = document.createElement('p');
                        translationElement.classList.add('ayat-translation');
                        translationElement.textContent = verse.translation.id;

                        verseElement.appendChild(arabicElement);
                        verseElement.appendChild(transliterationElement);
                        verseElement.appendChild(translationElement);
                        ayatContainer.appendChild(verseElement);

                        if (index < surahData.verses.length - 1) {
                            const separator = document.createElement('hr');
                            ayatContainer.appendChild(separator);
                        }
                    });
                }

                function convertToArabicNumber(number) {
                    const arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
                    return number.toString().split('').map(digit => arabicDigits[parseInt(digit)]).join('');
                }

                const prevButton = document.getElementById('prev-button');
                const nextButton = document.getElementById('next-button');

                function updateNavigationButtons() {
                    if (surahNumber <= 1) {
                        prevButton.disabled = true;
                    } else {
                        prevButton.disabled = false;
                    }

                    if (surahNumber >= 114) {
                        nextButton.disabled = true;
                    } else {
                        nextButton.disabled = false;
                    }
                }

                prevButton.addEventListener('click', () => {
                    if (surahNumber > 1) {
                        window.location.href = `/quran/surah/${surahNumber - 1}`;
                    }
                });

                nextButton.addEventListener('click', () => {
                    if (surahNumber < 114) {
                        window.location.href = `/quran/surah/${surahNumber + 1}`;
                    }
                });

                updateNavigationButtons();
            });
        </script>
</body>

</html>
