<script>
    // ─── Mobile Menu Toggle ───────────────────────────────────────────
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const drawer    = document.querySelector('.mobile-menu-drawer');

    toggleBtn.addEventListener('click', () => {
        toggleBtn.classList.toggle('active');
        drawer.classList.toggle('active');
        document.body.classList.toggle('no-scroll');
    });

    // Close drawer when clicking outside
    document.addEventListener('click', (e) => {
        if (!drawer.contains(e.target) && !toggleBtn.contains(e.target) && drawer.classList.contains('active')) {
            toggleBtn.classList.remove('active');
            drawer.classList.remove('active');
            document.body.classList.remove('no-scroll');
        }
    });

    // Close drawer when clicking a link
    document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(link => {
        link.addEventListener('click', () => {
            toggleBtn.classList.remove('active');
            drawer.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });
    });

    // ─── Mobile Dropdown Toggles ──────────────────────────────────────
    document.querySelectorAll('.mob-dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const menu = toggle.nextElementSibling;
            const chev = toggle.querySelector('.chev');

            document.querySelectorAll('.mob-dropdown-toggle').forEach(t => {
                if (t !== toggle) {
                    t.nextElementSibling.classList.remove('open');
                    t.querySelector('.chev').classList.remove('rotate');
                }
            });

            menu.classList.toggle('open');
            chev.classList.toggle('rotate');
        });
    });

    // ─── Evil Eye Cursor ──────────────────────────────────────────────
    const cursorContainer = document.getElementById('evil-eye-cursor');
    let mouseX = 0, mouseY = 0;

    const svgHTML = `<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 3445.6 3445.6">
        <defs>
            <style>.st0{fill:#170f15}.st1{fill:#fff}.st2{fill:#7bbae5}.st3{fill:#2d2c80}</style>
        </defs>
        <circle class="st3" cx="1722.8" cy="1722.8" r="1715.7"/>
        <circle class="st1" cx="1722.8" cy="1722.8" r="1144"/>
        <circle class="st2" cx="1722.8" cy="1722.8" r="638.6"/>
        <circle class="st0" cx="1722.8" cy="1722.8" r="276.4" transform="translate(-713.6 1722.8) rotate(-45)"/>
    </svg>`;

    cursorContainer.innerHTML = svgHTML;

    const svg    = cursorContainer.querySelector('svg');
    const pupil  = svg.querySelector('.st0');
    const centerX      = 1722.8;
    const centerY      = 1722.8;
    const maxDistance  = 200;

    function updatePupilPosition() {
        const dx = mouseX - (cursorContainer.offsetLeft + 20);
        const dy = mouseY - (cursorContainer.offsetTop  + 20);
        const distance    = Math.sqrt(dx * dx + dy * dy);
        const angle       = Math.atan2(dy, dx);
        const moveDistance = Math.min(distance, maxDistance) * 0.15;
        const newX = centerX + Math.cos(angle) * moveDistance;
        const newY = centerY + Math.sin(angle) * moveDistance;

        pupil.setAttribute('cx', newX);
        pupil.setAttribute('cy', newY);
    }

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        cursorContainer.style.left = (mouseX - 20) + 'px';
        cursorContainer.style.top  = (mouseY - 20) + 'px';
        updatePupilPosition();
    });
</script>
