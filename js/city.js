let cities = [];
let container = document.getElementById("city-container");
let position = 0;

// جلب البيانات من قاعدة البيانات
fetch('get_cities.php')
    .then(response => response.json())
    .then(data => {
        cities = data;
        createCards();
        updateCards();
    })
    .catch(error => {
        console.error('خطأ في جلب المدن:', error);
        container.innerHTML = '<p style="text-align:center; color:red;">حدث خطأ في تحميل المدن</p>';
    });

function createCards() {
    container.innerHTML = ''; // تفريغ الحاوية

    cities.forEach((city, index) => {
        const card = document.createElement("div");
        card.className = "card";

        if (index === 0) card.classList.add("left");
        if (index === 1) card.classList.add("center");
        if (index === 2) card.classList.add("right");

        // تحديد مسار الصورة
        const imgSrc = city.cover_image ? `images/${city.cover_image}` : 'images/default-city.jpg';

        card.innerHTML = `
            <div class="city-img-frame">
                <img src="${imgSrc}" class="city-image" alt="${city.name}">
                <img src="images/decoration.png" class="gate-frame">
            </div>
            <h3>${city.name}</h3>
            <p>${city.region || 'مدينة فلسطينية'}</p>
            <a class="explore-btn" href="about.php?id=${city.id}">
    أدخل إلى ${city.name}
            </a>
        `;

        container.appendChild(card);
    });

    updateCards();
}

function updateCards() {
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        card.classList.remove("left", "center", "right", "hidden");
    });

    const total = cards.length;
    if (total === 0) return;

    const left = (position) % total;
    const center = (position + 1) % total;
    const right = (position + 2) % total;

    cards.forEach((card, index) => {
        if (index === left) card.classList.add("left");
        else if (index === center) card.classList.add("center");
        else if (index === right) card.classList.add("right");
        else card.classList.add("hidden");
    });
}

function changeCity(step) {
    const cards = document.querySelectorAll(".card");
    if (cards.length === 0) return;
    position = (position + step + cards.length) % cards.length;
    updateCards();
}