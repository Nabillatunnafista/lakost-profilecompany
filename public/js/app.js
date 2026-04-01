/* ═══════════════════════════════════════════════
   LAkost — app.js
   Global: navbar scroll, hamburger, scroll-reveal
   ═══════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

    /* ── Navbar Scroll Effect (Efek Navbar saat Di-scroll) ── */
    const navbar = document.getElementById('navbar');
    if (navbar) {
        const onScroll = () => {
            // Menambahkan class 'scrolled' jika halaman di-scroll lebih dari 48px
            navbar.classList.toggle('scrolled', window.scrollY > 48);
        };
        
        window.addEventListener('scroll', onScroll, { passive: true });
        // Jalankan sekali saat halaman pertama kali dimuat
        onScroll(); 
    }

    /* ── Hamburger / Mobile Nav (Menu Navigasi Seluler) ── */
    const burger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-links');

    if (burger && navMenu) {
        // Fungsi klik pada tombol hamburger
        burger.addEventListener('click', () => {
            const isOpen = burger.classList.toggle('open');
            navMenu.classList.toggle('open', isOpen);
            burger.setAttribute('aria-expanded', isOpen);
        });

        // Menutup menu otomatis jika salah satu link diklik
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                burger.classList.remove('open');
                navMenu.classList.remove('open');
                burger.setAttribute('aria-expanded', false);
            });
        });

        // Menutup menu jika pengguna mengklik di luar area navbar
        document.addEventListener('click', (e) => {
            if (!navbar.contains(e.target)) {
                burger.classList.remove('open');
                navMenu.classList.remove('open');
                burger.setAttribute('aria-expanded', false);
            }
        });
    }

    /* ── Scroll Reveal (Animasi Muncul saat Di-scroll) ── */
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Efek stagger (berurutan) untuk elemen dalam parent yang sama
                    const siblings = Array.from(
                        entry.target.parentElement.querySelectorAll('.reveal:not(.visible)')
                    );
                    const delay = siblings.indexOf(entry.target);
                    
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, Math.max(0, delay) * 80); // Jeda 80ms antar elemen
                    
                    // Berhenti mengamati elemen setelah animasi muncul
                    io.unobserve(entry.target);
                }
            });
        }, { 
            threshold: 0.12, 
            rootMargin: '0px 0px -40px 0px' 
        });

        reveals.forEach(el => io.observe(el));
    }

    /* ── Smooth Anchor Scroll (Scroll Halus pada Link ID) ── */
    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const url = new URL(anchor.href, location.href);
            const hash = url.hash;

            // Hanya proses jika link mengarah ke bagian di halaman yang sama
            if (url.pathname === location.pathname && hash) {
                const target = document.querySelector(hash);
                if (target) {
                    e.preventDefault();
                    
                    const offset = 80; // Sesuaikan dengan tinggi navbar Anda
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    
                    window.scrollTo({ 
                        top: top, 
                        behavior: 'smooth' 
                    });
                }
            }
        });
    });

    /* ── Logika Scroll to Top ── */
    const scrollTopBtn = document.getElementById('scrollToTop');

    if (scrollTopBtn) {
        // Tampilkan tombol jika scroll lebih dari 400px
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        // Fungsi klik untuk balik ke atas
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
