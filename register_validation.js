function submitRegistration() {
  const errorDiv = document.getElementById('error-message');
  errorDiv.classList.add('d-none');
  errorDiv.innerHTML = '';

  const role = document.getElementById('role').value.trim();
  const nom = document.querySelector('input[name="nom"]').value.trim();
  const prenom = document.querySelector('input[name="prenom"]').value.trim();
  const cin = document.querySelector('input[name="cin"]').value.trim();
  const email = document.querySelector('input[name="email"]').value.trim();
  const pseudo = document.querySelector('input[name="pseudo"]').value.trim();
  const password = document.querySelector('input[name="password"]').value.trim();
  const confirmPassword = document.querySelector('input[name="confirm_password"]').value.trim();

  const nomAssociation = document.querySelector('input[name="nom_association"]')?.value.trim();
  const adresseAssociation = document.querySelector('input[name="adresse_association"]')?.value.trim();
  const idFiscal = document.querySelector('input[name="id_fiscal"]')?.value.trim();
  const logo = document.querySelector('input[name="logo"]')?.files[0];

  function showError(message) {
      errorDiv.innerHTML = message;
      errorDiv.classList.remove('d-none');
      window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  if (role === "") {
      showError("Veuillez sélectionner votre rôle.");
      return;
  }

  if (nom === "" || prenom === "" || cin === "" || email === "" || pseudo === "" || password === "" || confirmPassword === "") {
      showError("Veuillez remplir tous les champs obligatoires.");
      return;
  }

  if (cin.length !== 8 || isNaN(cin)) {
      showError("Le numéro CIN doit contenir exactement 8 chiffres.");
      return;
  }

  if (!email.includes('@') || !email.includes('.')) {
      showError("Veuillez entrer une adresse email valide.");
      return;
  }

  if (!/^[A-Za-z]+$/.test(pseudo)) {
      showError("Le pseudo doit être composé uniquement de lettres.");
      return;
  }

  if (password.length < 8 || (!password.endsWith('$') && !password.endsWith('#'))) {
      showError("Le mot de passe doit contenir au moins 8 caractères et finir par $ ou #.");
      return;
  }

  if (password !== confirmPassword) {
      showError("Les mots de passe ne correspondent pas.");
      return;
  }

  if (role === "association") {
      if (nomAssociation === "" || adresseAssociation === "" || idFiscal === "") {
          showError("Veuillez remplir tous les champs de l'association.");
          return;
      }

      if (!idFiscal.startsWith('$') || idFiscal.length !== 6) {
          showError("L'identifiant fiscal doit commencer par '$', suivi de 3 lettres MAJUSCULES et 2 chiffres.");
          return;
      }

      if (!logo) {
          showError("Veuillez télécharger le logo de l'association.");
          return;
      }
  }

  // Tout est valide
  document.querySelector('form').submit();
}
function submitProfileModification() {
    const errorDiv = document.getElementById('error-message');
    
    // Reset previous errors
    if (errorDiv) {
        errorDiv.classList.add('d-none');
        errorDiv.innerHTML = '';
    }
  
    // Get form fields
    const email = document.querySelector('input[name="email"]').value.trim();
    const idFiscal = document.querySelector('input[name="identifiant_fiscal"]').value.trim();
    const newPassword = document.querySelector('input[name="new_password"]').value.trim();
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value.trim();
  
    // Helper to display error
    function showError(message) {
        if (errorDiv) {
            errorDiv.innerHTML = message;
            errorDiv.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
  
    // Validate Email
    if (email === "" || !email.includes('@') || !email.includes('.')) {
        showError("❌ Veuillez entrer une adresse email valide.");
        return;
    }
  
    // Validate Identifiant Fiscal
    if (idFiscal !== "" && (!idFiscal.startsWith('$') || idFiscal.length !== 6)) {
        showError("❌ L'identifiant fiscal doit commencer par '$', suivi de 3 lettres MAJUSCULES et 2 chiffres.");
        return;
    }
  
    // Validate Password (if filled)
    if (newPassword !== "" || confirmPassword !== "") {
        if (newPassword.length < 8 || (!newPassword.endsWith('$') && !newPassword.endsWith('#'))) {
            showError("❌ Le mot de passe doit contenir au moins 8 caractères et finir par $ ou #.");
            return;
        }
        if (newPassword !== confirmPassword) {
            showError("❌ Les mots de passe ne correspondent pas.");
            return;
        }
    }
  
    // ✅ All good, submit
    document.querySelector('form').submit();
  }
  
  
  
document.getElementById('role').addEventListener('change', function () {
    const fields = document.getElementById('associationFields');
    if (this.value === 'association') {
      fields.style.display = 'block';
    } else {
      fields.style.display = 'none';
    }
  });
  