function toggleFavorite(name) {
  fetch(`?page=favorites&toggle=${name}`)
    .then(() => location.reload());
}

let selectedPokemon = [];
let compareMode = false;

function startCompare() {
  compareMode = true;
  selectedPokemon = [];
  document.getElementById('compareMode').style.display = 'block';
  document.getElementById('compareBtn').style.display = 'none';
  
  const checkboxes = document.querySelectorAll('.compare-checkbox');
  checkboxes.forEach(cb => cb.style.display = 'block');
  
  updateSelectedCount();
}

function cancelCompare() {
  compareMode = false;
  selectedPokemon = [];
  document.getElementById('compareMode').style.display = 'none';
  document.getElementById('compareBtn').style.display = 'inline-block';
  
  const checkboxes = document.querySelectorAll('.compare-checkbox');
  checkboxes.forEach(cb => {
    cb.style.display = 'none';
    cb.querySelector('input').checked = false;
  });
  
  updateSelectedCount();
}

function handleCheckbox(checkbox) {
  const pokemonId = checkbox.value;
  
  if (checkbox.checked) {
    if (selectedPokemon.length < 2) {
      selectedPokemon.push(pokemonId);
    } else {
      checkbox.checked = false;
      return;
    }
  } else {
    selectedPokemon = selectedPokemon.filter(id => id !== pokemonId);
  }
  
  updateSelectedCount();
}

function updateSelectedCount() {
  document.getElementById('selectedCount').textContent = `(${selectedPokemon.length}/2)`;
  document.getElementById('compareSubmit').disabled = selectedPokemon.length !== 2;
}

function submitCompare() {
  if (selectedPokemon.length === 2) {
    window.location.href = `?page=compare&id1=${selectedPokemon[0]}&id2=${selectedPokemon[1]}`;
  }
}

function toggleMobileMenu() {
  const nav = document.querySelector('.header-nav');
  nav.classList.toggle('mobile-open');
}

document.addEventListener('click', function(event) {
  const nav = document.querySelector('.header-nav');
  const toggle = document.querySelector('.mobile-menu-toggle');
  
  if (nav && nav.classList.contains('mobile-open')) {
    if (!nav.contains(event.target) && !toggle.contains(event.target)) {
      nav.classList.remove('mobile-open');
    }
  }
});
