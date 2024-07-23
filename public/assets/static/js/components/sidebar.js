import isDesktop from '../helper/isDesktop';

/**
 * Calculate nested children height in sidebar menu
 * @param {HTMLElement} el
 * @param {boolean} deep
 * @returns {number}
 */
const calculateChildrenHeight = (el, deep = false) => {
  const children = el.children;
  let height = 0;

  for (let i = 0; i < children.length; i++) {
    const child = children[i];
    height += child.querySelector('.submenu-link').clientHeight;

    // 2-level menu
    if (deep && child.classList.contains('has-sub')) {
      const subsubmenu = child.querySelector('.submenu');

      // Only calculate height for the open level 2 submenu
      if (subsubmenu.classList.contains('submenu-open')) {
        const childrenHeight = [...subsubmenu.querySelectorAll('.submenu-link')].reduce((acc, curr) => acc + curr.clientHeight, 0);
        height += childrenHeight;
      }
    }
  }
  el.style.setProperty('--submenu-height', `${height}px`);
  return height;
};

/**
 * Sidebar component
 */
class Sidebar {
  constructor(el, options = {}) {
    this.sidebarEl = el instanceof HTMLElement ? el : document.querySelector(el);
    this.options = options;
    this.init();
  }

  /**
   * Initialize the sidebar
   */
  init() {
    // Add event listener to sidebar
    document.querySelectorAll('.burger-btn').forEach((el) => el.addEventListener('click', this.toggle.bind(this)));
    document.querySelectorAll('.sidebar-hide').forEach((el) => el.addEventListener('click', this.toggle.bind(this)));
    window.addEventListener('resize', this.onResize.bind(this));

    const closeAllSubmenus = (excludeEl, isLevelOne) => {
      document.querySelectorAll('.submenu-open').forEach((submenu) => {
        if (submenu !== excludeEl) {
          const parentItem = submenu.closest('.has-sub');
          if (isLevelOne) {
            submenu.classList.remove('submenu-open');
            submenu.classList.add('submenu-closed');
          } else if (parentItem && parentItem.querySelector('.submenu') !== submenu) {
            submenu.classList.remove('submenu-open');
            submenu.classList.add('submenu-closed');
          }
        }
      });
    };

    const toggleSubmenu = (el, isLevelOne = false) => {
      if (el.classList.contains('submenu-open')) {
        el.classList.remove('submenu-open');
        el.classList.add('submenu-closed');
      } else {
        closeAllSubmenus(el, isLevelOne);
        el.classList.remove('submenu-closed');
        el.classList.add('submenu-open');
      }

      // Close all level 2 submenus except the one being toggled
      if (!isLevelOne) {
        const levelTwoSubmenus = document.querySelectorAll('.submenu-level-2');
        levelTwoSubmenus.forEach((submenu) => {
          if (submenu !== el) {
            submenu.classList.remove('submenu-open');
            submenu.classList.add('submenu-closed');
          }
        });
      }
    };

    const sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
    sidebarItems.forEach((sidebarItem) => {
      sidebarItem.querySelector('.sidebar-link').addEventListener('click', (e) => {
        e.preventDefault();
        const submenu = sidebarItem.querySelector('.submenu');
        toggleSubmenu(submenu, true);
      });

      // If submenu has submenu
      const submenuItems = sidebarItem.querySelectorAll('.submenu-item.has-sub');
      submenuItems.forEach((item) => {
        item.addEventListener('click', (e) => {
          e.stopPropagation();
          const submenuLevelTwo = item.querySelector('.submenu');
          submenuLevelTwo.classList.add('submenu-level-2');
          toggleSubmenu(submenuLevelTwo);

          // Recalculate parent menu height
          calculateChildrenHeight(item.parentElement, true);
        });
      });
    });

    // Perfect Scrollbar Init
    if (typeof PerfectScrollbar === 'function') {
      const container = document.querySelector('.sidebar-wrapper');
      new PerfectScrollbar(container, {
        wheelPropagation: true,
      });
    }

    // Scroll into active sidebar
    setTimeout(() => {
      const activeSidebarItem = document.querySelector('.sidebar-item.active');
      if (activeSidebarItem) {
        this.forceElementVisibility(activeSidebarItem);
      }
    }, 300);

    if (this.options.recalculateHeight) {
      this.reInitSubMenuHeight(this.sidebarEl);
    }
  }

  /**
   * On Sidebar Resize Event
   */
  onResize() {
    if (isDesktop(window)) {
      this.sidebarEl.classList.add('active');
      this.sidebarEl.classList.remove('inactive');
    } else {
      this.sidebarEl.classList.remove('active');
    }

    // reset
    this.deleteBackdrop();
    this.toggleOverflowBody(true);
  }

  /**
   * Toggle Sidebar
   */
  toggle() {
    const sidebarState = this.sidebarEl.classList.contains('active');
    if (sidebarState) {
      this.hide();
    } else {
      this.show();
    }
  }

  /**
   * Show Sidebar
   */
  show() {
    this.sidebarEl.classList.add('active');
    this.sidebarEl.classList.remove('inactive');
    this.createBackdrop();
    this.toggleOverflowBody();
  }

  /**
   * Hide Sidebar
   */
  hide() {
    this.sidebarEl.classList.remove('active');
    this.sidebarEl.classList.add('inactive');
    this.deleteBackdrop();
    this.toggleOverflowBody();
  }

  /**
   * Create Sidebar Backdrop
   */
  createBackdrop() {
    if (isDesktop(window)) return;
    this.deleteBackdrop();
    const backdrop = document.createElement('div');
    backdrop.classList.add('sidebar-backdrop');
    backdrop.addEventListener('click', this.hide.bind(this));
    document.body.appendChild(backdrop);
  }

  /**
   * Delete Sidebar Backdrop
   */
  deleteBackdrop() {
    const backdrop = document.querySelector('.sidebar-backdrop');
    if (backdrop) {
      backdrop.remove();
    }
  }

  /**
   * Toggle Overflow Body
   */
  toggleOverflowBody(active) {
    if (isDesktop(window)) return;
    const sidebarState = this.sidebarEl.classList.contains('active');
    const body = document.querySelector('body');
    if (typeof active === 'undefined') {
      body.style.overflowY = sidebarState ? 'hidden' : 'auto';
    } else {
      body.style.overflowY = active ? 'auto' : 'hidden';
    }
  }

  isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  forceElementVisibility(el) {
    if (!this.isElementInViewport(el)) {
      el.scrollIntoView(false);
    }
  }

  /**
   * Reinitialize Submenu Height
   */
  reInitSubMenuHeight(sidebarEl) {
    if (!sidebarEl) return;

    // Get submenus size
    const submenus = sidebarEl.querySelectorAll('.sidebar-item.has-sub .submenu');
    submenus.forEach((submenu) => {
      const sidebarItem = submenu.parentElement;
      if (sidebarItem.classList.contains('active')) {
        submenu.classList.add('submenu-open');
      } else {
        submenu.classList.add('submenu-closed');
      }
      setTimeout(() => {
        calculateChildrenHeight(submenu, true);
      }, 50);
    });
  }
}

// Initialize Sidebar
const sidebarEl = document.getElementById('sidebar');

// On First Load
const onFirstLoad = (sidebarEl) => {
  if (!sidebarEl) return;
  if (isDesktop(window)) {
    sidebarEl.classList.add('active');
    sidebarEl.classList.add('sidebar-desktop');
  }

  // Get submenus size
  const submenus = document.querySelectorAll('.sidebar-item.has-sub .submenu');
  submenus.forEach((submenu) => {
    const sidebarItem = submenu.parentElement;
    if (sidebarItem.classList.contains('active')) {
      submenu.classList.add('submenu-open');
    } else {
      submenu.classList.add('submenu-closed');
    }
    setTimeout(() => {
      calculateChildrenHeight(submenu, true);
    }, 50);
  });
};

// DOMContentLoaded handler
if (document.readyState !== 'loading') {
  onFirstLoad(sidebarEl);
} else {
  window.addEventListener('DOMContentLoaded', () => onFirstLoad(sidebarEl));
}

if (sidebarEl) {
  new Sidebar(sidebarEl, { recalculateHeight: true });
}

// Expose Sidebar globally
window.Sidebar = Sidebar;
