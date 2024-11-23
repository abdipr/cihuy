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

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        #search-bar {
            font-family: inherit;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1em;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        #search-bar:focus, body.dark-mode #search-bar:focus {
            border-color: var(--color-2);
            outline: none;
            box-shadow: 0 0 5px rgba(var(--color-1-rgb), 0.5);
        }

        #surah-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }

        .surah-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            height: auto;
        }

        .surah-item:hover,
        body.dark-mode .surah-item:hover {
            cursor: pointer;
            background: rgba(var(--color-1-rgb), 0.25);
            border-color: var(--color-2);
        }


        .number {
            font-size: 1.2em;
            font-weight: bold;
            color: #6b7280;
            margin-right: 16px;
            flex-shrink: 0;
            text-align: center;
            width: 30px;
        }

        .content {
            flex-grow: 1;
        }

        .content .name {
            font-size: 1.2em;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        .content .translation {
            font-size: 0.9em;
            color: #6b7280;
            margin: 0;
            padding: 0;
        }

        .arabic-name {
            font-family: 'OmarFont', serif;
            font-size: 1.8em;
            color: #1f2937;
            text-align: right;
        }

        @media (max-width: 768px) {
            .surah-item {
                padding: 10px 12px;
            }

            .content .name {
                font-size: 1em;
            }

            .arabic-name {
                font-size: 1.4em;
            }
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

        body.dark-mode .surah-item,
        body.dark-mode #search-bar {

            background-color: #444;
            border-color: #333;
            color: var(--dark-text-1);
        }

        body.dark-mode .name,
        body.dark-mode h1 {
            color: var(--dark-text);
        }

        body.dark-mode .arabic-name,
        body.dark-mode .translation {
            color: var(--dark-text-1);
        }

        body.dark-mode .number {
            color: var(--color-1);
        }
    </style>
</head>

<body>
    <?php include "header.php";?>
        <div class="container">
            <h1>Daftar Surat</h1>
            <input type="text" id="search-bar" placeholder="Cari surat berdasarkan nama...">
            <div id="surah-list"></div>
        </div>

        <script src="/script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const surahListContainer = document.getElementById("surah-list");
                const searchBar = document.getElementById("search-bar");
                const localStorageKey = "surahData";
                let surahData = [];
                const header = document.querySelector('.header');
                let lastScrollY = 0;

                window.addEventListener('scroll', () => {
                    if (window.scrollY > lastScrollY) {
                        header.style.transform = 'translateY(-100%)';
                    } else {
                        header.style.transform = 'translateY(0)';
                    }
                    lastScrollY = window.scrollY;
                });

                function renderSurahList(filteredSurah) {
                    surahListContainer.innerHTML = "";
                    filteredSurah.forEach(surah => {
                        const surahElement = document.createElement("div");
                        surahElement.classList.add("surah-item");

                        const numberElement = document.createElement("div");
                        numberElement.classList.add("number");
                        numberElement.textContent = surah.number;

                        const contentElement = document.createElement("div");
                        contentElement.classList.add("content");

                        const nameElement = document.createElement("p");
                        nameElement.classList.add("name");
                        nameElement.textContent = surah.name.transliteration.id;

                        const translationElement = document.createElement("p");
                        translationElement.classList.add("translation");
                        translationElement.textContent = `${surah.name.translation.id} · ${surah.numberOfVerses} ayat`;

                        const arabicElement = document.createElement("div");
                        arabicElement.classList.add("arabic-name");
                        arabicElement.textContent = surah.name.short;

                        contentElement.appendChild(nameElement);
                        contentElement.appendChild(translationElement);

                        surahElement.appendChild(numberElement);
                        surahElement.appendChild(contentElement);
                        surahElement.appendChild(arabicElement);

                        const surahLink = document.createElement("a");
                        surahLink.href = `/quran/surah/${surah.number}`;
                        surahLink.style.textDecoration = "none";
                        surahLink.style.color = "inherit";

                        surahLink.appendChild(surahElement);
                        surahListContainer.appendChild(surahLink);
                    });
                }

                function filterSurahList(query) {
                    const filteredSurah = surahData.filter(surah =>
                        surah.name.transliteration.id.toLowerCase().includes(query.toLowerCase())
                    );
                    renderSurahList(filteredSurah);
                }

                const localData = localStorage.getItem(localStorageKey);

                if (localData) {
                    surahData = JSON.parse(localData);
                    renderSurahList(surahData);
                } else {
                    fetch("https://api.quran.gading.dev/surah/")
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Gagal mengambil data dari API");
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.code !== 200) {
                                throw new Error("Data tidak ditemukan");
                            }
                            surahData = data.data;
                            localStorage.setItem(localStorageKey, JSON.stringify(surahData));
                            renderSurahList(surahData);
                        })
                        .catch(error => {
                            surahListContainer.innerHTML = `<p>Error: ${error.message}</p>`;
                        });
                }
                searchBar.addEventListener("input", (e) => {
                    filterSurahList(e.target.value);
                });
            });
        </script>
</body>

</html>
