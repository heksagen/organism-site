import './bootstrap';
import Lenis from '@studio-freight/lenis'

const lenis = new Lenis({
  duration: 1.1,
  smoothWheel: true,
  smoothTouch: false,
})

// --- Parallax (for elements with data-parallax) ---
function updateParallax() {
  const imgs = document.querySelectorAll("[data-parallax]");
  const vh = window.innerHeight;

  imgs.forEach((img) => {
    const strength = Number(img.getAttribute("data-parallax-strength") || 40);
    const rect = img.getBoundingClientRect();

    // skip if far offscreen
    if (rect.bottom < -200 || rect.top > vh + 200) return;

    // progress: negative when above center, positive when below center
    const progress = (rect.top + rect.height / 2 - vh / 2) / vh;

    // invert so it feels natural
    const y = -progress * strength;

    img.style.transform = `translate3d(0, ${y}px, 0) scale(1.10)`;
  });
}

function raf(time) {
  lenis.raf(time);
  updateParallax();            // ✅ add this line
  requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
  lenis.destroy();

  // Optional: freeze parallax in reduced motion
  document.querySelectorAll("[data-parallax]").forEach((img) => {
    img.style.transform = "translate3d(0,0,0) scale(1.10)";
  });
}

// Unified scroll reveal (pop + portal)
function initScrollReveal() {
  const items = document.querySelectorAll("[data-reveal], [data-portal]");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-revealed");
          observer.unobserve(entry.target); // reveal once
        }
      });
    },
    { threshold: 0.15 }
  );

  items.forEach((el) => observer.observe(el));
}

document.addEventListener("DOMContentLoaded", initScrollReveal);
