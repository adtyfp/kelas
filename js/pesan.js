// ===== Search Functionality =====
function showSearch() {
  const searchContainer = document.getElementById("searchContainer");
  searchContainer.style.display = "flex";
  document.getElementById("searchInput").focus();
}

function hideSearch() {
  const searchContainer = document.getElementById("searchContainer");
  searchContainer.style.display = "none";
  document.getElementById("searchInput").value = "";
  filterChats("");
}

function filterChats(query) {
  const chats = document.querySelectorAll(".chat-item");
  const q = query.toLowerCase();

  chats.forEach((chat) => {
    const name = chat.querySelector(".contact-name").textContent.toLowerCase();
    const message = chat.querySelector(".message-preview").textContent.toLowerCase();

    if (name.includes(q) || message.includes(q)) {
      chat.style.display = "flex";
    } else {
      chat.style.display = "none";
    }
  });
}

document.getElementById("searchInput").addEventListener("input", function () {
  filterChats(this.value);
});

// Click outside to close search
document.addEventListener("click", function (event) {
  const searchContainer = document.getElementById("searchContainer");
  const isInsideSearch = event.target.closest(".search-container");
  const isSearchIcon = event.target.closest(".header-icon i.fa-search");

  if (searchContainer.style.display === "flex" && !isInsideSearch && !isSearchIcon) {
    hideSearch();
  }
});

// ===== Navbar Active Detection =====
const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".bottom-nav .nav-item").forEach((link) => {
  if (link.getAttribute("href").includes(currentPage)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});

// ===== Menu Placeholder =====
function toggleMenu() {
  console.log("Menu toggled");
  // Add your menu open/close code here
}

// ===== Refresh Placeholder =====
function refreshChats() {
  console.log("Refreshing chats...");
  // Add your refresh logic here
}

// ===== Open Chat by ID =====
function openChat(chatId) {
  window.location.href = `isi-chat.php?id=${chatId}`;
}

// Optional: for manual navigation handling
function navigate(page) {
  console.log("Navigating to:", page);
  document.querySelectorAll(".nav-item").forEach((item) =>
    item.classList.remove("active")
  );
  event.currentTarget.classList.add("active");
}
