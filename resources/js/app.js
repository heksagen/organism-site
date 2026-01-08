import './bootstrap';
import Lenis from '@studio-freight/lenis'

const lenis = new Lenis({
  duration: 1.1,
  smoothWheel: true,
  smoothTouch: false,
})

function raf(time) {
  lenis.raf(time)
  requestAnimationFrame(raf)
}
requestAnimationFrame(raf)

if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
  lenis.destroy()
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
