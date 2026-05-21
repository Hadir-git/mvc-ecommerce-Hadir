<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&H Tech - Manage Account</title>
  <?php include "header.php"; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg-void:     #080709;
      --bg-card:     #111009;
      --bg-input:    #0d0b08;
      --border-dim:  #2e2112;
      --gold-bright: #c9922a;
      --gold-mid:    #a87620;
      --gold-pale:   #e8c87a;
      --gold-line:   rgba(201,146,42,.3);
      --text-main:   #e2d4b8;
      --text-muted:  #6a5a40;
      --error-col:   #c0614a;
      --success-col: #7aaa88;
    }

    body {
      background-color: var(--bg-void);
      background-image: radial-gradient(ellipse 65% 40% at 50% 0%,
        rgba(180,120,20,.09) 0%, transparent 60%);
      color: var(--text-main);
      font-family: 'Raleway', sans-serif;
      min-height: 100vh;
      padding: 2rem 1rem 3rem;
    }

    /* ── Page wrapper ── */
    .page {
      max-width: 520px;
      margin: 0 auto;
      animation: riseIn .45s cubic-bezier(.22,.68,0,1.15) both;
    }

    @keyframes riseIn {
      from { opacity:0; transform:translateY(20px) scale(.98); }
      to   { opacity:1; transform:translateY(0)    scale(1);   }
    }

    /* ── Header ── */
    .header { display: flex; align-items: center; gap: 16px; margin-bottom: 2.4rem; }

    .avatar {
      width: 52px; height: 52px; border-radius: 50%;
      border: 1px solid var(--gold-mid);
      background: var(--bg-card);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Cinzel', serif;
      font-size: 13px; font-weight: 400; color: var(--gold-pale);
      flex-shrink: 0; letter-spacing: .1em;
      box-shadow: 0 0 18px rgba(201,146,42,.12);
    }

    .header-text h2 {
      font-family: 'Cinzel', serif;
      font-size: .85rem;
      font-weight: 400;
      letter-spacing: .45em;
      text-transform: uppercase;
      color: var(--gold-pale);
      text-shadow: 0 0 20px rgba(201,146,42,.25);
    }
    .header-text p {
      font-size: .78rem;
      color: var(--text-muted);
      margin-top: 4px;
      letter-spacing: .06em;
    }

    /* ── Card ── */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--border-dim);
      border-radius: 4px;
      overflow: visible;
      position: relative;
      box-shadow:
        0 0 0 1px rgba(180,130,30,.04),
        0 20px 70px rgba(0,0,0,.75);
    }

    /* Corner ornaments */
    .card::before, .card::after,
    .card .corner-tr::before, .card .corner-bl::before {
      content: '';
      position: absolute;
      width: 16px; height: 16px;
      border-color: var(--gold-mid);
      border-style: solid;
      opacity: .55;
      pointer-events: none;
    }
    .card::before    { top:9px;    left:9px;   border-width:1px 0 0 1px; }
    .card::after     { bottom:9px; right:9px;  border-width:0 1px 1px 0; }
    .card .corner-tr, .card .corner-bl { position:absolute; inset:0; pointer-events:none; }
    .card .corner-tr::before { top:9px;    right:9px;  border-width:1px 1px 0 0; }
    .card .corner-bl::before { bottom:9px; left:9px;   border-width:0 0 1px 1px; }

    /* ── Card top ── */
    .card-top {
      padding: 1.1rem 1.5rem;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border-dim);
      background: rgba(0,0,0,.2);
    }

    .card-top span {
      font-family: 'Cinzel', serif;
      font-size: .62rem;
      font-weight: 400;
      letter-spacing: .35em;
      text-transform: uppercase;
      color: var(--text-muted);
    }

    /* ── Edit button ── */
    .edit-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 6px 16px;
      background: transparent;
      border: 1px solid var(--gold-mid);
      border-radius: 2px;
      cursor: pointer;
      font-family: 'Cinzel', serif;
      font-size: .58rem;
      font-weight: 400;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: var(--gold-pale);
      transition: border-color .25s, background .25s, color .25s;
    }
    .edit-btn:hover  { border-color: var(--gold-pale); background: rgba(201,146,42,.06); color: #fff; }
    .edit-btn.active { background: rgba(201,146,42,.1); border-color: var(--gold-bright); color: #fff; }

    /* ── Card body ── */
    .card-body { padding: 2rem 2rem 1.6rem; }

    /* ── Section label ── */
    .section-label {
      font-family: 'Cinzel', serif;
      font-size: .58rem;
      font-weight: 400;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: .35em;
      margin-bottom: 1.4rem;
      padding-bottom: .6rem;
      position: relative;
    }
    .section-label::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 100%; height: 1px;
      background: linear-gradient(90deg, var(--border-dim) 0%, transparent 80%);
    }

    /* ── Fields ── */
    .field { margin-bottom: 1.6rem; position: relative; }

    .field label {
      display: flex; align-items: center; gap: 7px;
      font-family: 'Cinzel', serif;
      font-size: .58rem;
      font-weight: 400;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: .22em;
      margin-bottom: .55rem;
      padding-left: 1.6rem;
      transition: color .25s;
      position: static !important;
      transform: none !important;
      pointer-events: none;
    }
    .field:focus-within label { color: var(--gold-pale); }

    .field-icon {
      position: absolute;
      left: 0;
      bottom: .72rem;
      font-size: 15px;
      color: var(--text-muted);
      pointer-events: none;
      transition: color .25s;
      line-height: 1;
    }
    .field:focus-within .field-icon { color: var(--gold-bright); }

    .field input {
      display: block !important;
      width: 100% !important;
      background: var(--bg-input) !important;
      border: none !important;
      border-bottom: 1px solid var(--border-dim) !important;
      border-radius: 0 !important;
      box-shadow: none !important;
      outline: none !important;
      height: auto !important;
      margin: 0 !important;
      padding: .65rem .4rem .65rem 1.6rem !important;
      color: var(--text-main) !important;
      -webkit-text-fill-color: var(--text-main) !important;
      font-family: 'Raleway', sans-serif !important;
      font-size: .92rem !important;
      font-weight: 300 !important;
      letter-spacing: .04em !important;
      caret-color: var(--gold-bright);
      transition: border-color .25s, opacity .25s;
    }
    .field input:focus {
      border-bottom-color: var(--gold-bright) !important;
      box-shadow: none !important;
      background: var(--bg-input) !important;
    }
    .field input::placeholder { color: var(--text-muted); opacity: .4; }
    .field input:disabled {
      opacity: .45;
      cursor: not-allowed;
    }
    .field input:-webkit-autofill,
    .field input:-webkit-autofill:focus {
      -webkit-box-shadow: 0 0 0 1000px var(--bg-input) inset !important;
      -webkit-text-fill-color: var(--text-main) !important;
    }

    /* Gold bar on focus */
    .gold-bar {
      position: absolute;
      bottom: 0; left: 0;
      height: 1px; width: 0;
      background: linear-gradient(90deg, var(--gold-mid), var(--gold-pale));
      transition: width .35s cubic-bezier(.4,0,.2,1);
      pointer-events: none;
    }
    .field:focus-within .gold-bar { width: 100%; }

    .hint {
      font-size: .7rem;
      color: var(--text-muted);
      margin-top: 4px;
      padding-left: 1.6rem;
      letter-spacing: .04em;
    }

    /* ── Divider ── */
    .divider {
      display: flex;
      align-items: center;
      gap: .8rem;
      margin: 1.6rem 0;
    }
    .divider .line { flex:1; height:1px; background:var(--border-dim); }
    .divider .diamond {
      width: 6px; height: 6px;
      background: var(--gold-mid);
      transform: rotate(45deg);
      opacity: .6;
      flex-shrink: 0;
    }

    /* ── Password row ── */
    .pw-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 480px) { .pw-row { grid-template-columns: 1fr; } }

    /* ── Submit button ── */
    .submit-btn {
      display: block !important;
      width: 100% !important;
      background: transparent !important;
      border: 1px solid var(--gold-mid) !important;
      border-radius: 2px !important;
      box-shadow: none !important;
      color: var(--gold-pale) !important;
      font-family: 'Cinzel', serif !important;
      font-size: .68rem !important;
      font-weight: 400 !important;
      letter-spacing: .4em !important;
      text-transform: uppercase !important;
      padding: .85rem 1rem !important;
      height: auto !important;
      line-height: normal !important;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: border-color .3s, color .3s, opacity .3s;
      margin-top: .8rem;
      display: flex; align-items: center; justify-content: center; gap: 10px;
    }
    .submit-btn::before {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(201,146,42,.1), rgba(232,200,122,.04));
      opacity: 0;
      transition: opacity .3s;
    }
    .submit-btn:not(:disabled):hover { border-color: var(--gold-pale) !important; color: #fff !important; }
    .submit-btn:not(:disabled):hover::before { opacity: 1; }
    .submit-btn:not(:disabled):active { transform: scale(.99); }
    .submit-btn:disabled { opacity: .3 !important; cursor: not-allowed; }

    /* ── Messages ── */
    .msg { font-size: .76rem; margin-bottom: 1.4rem; min-height: 18px; }
    .success {
      color: var(--success-col);
      padding: .45rem .75rem;
      background: rgba(122,170,136,.07);
      border-left: 1px solid var(--success-col);
      letter-spacing: .05em;
      font-family: 'Raleway', sans-serif;
    }
    .error {
      color: #d4785f;
      padding: .45rem .75rem;
      background: rgba(192,97,74,.07);
      border-left: 1px solid var(--error-col);
      letter-spacing: .05em;
      font-family: 'Raleway', sans-serif;
    }
  </style>
</head>
<body>

<div class="page">

  <!-- Header -->
  <div class="header">
    <div class="avatar">H&amp;H</div>
    <div class="header-text">
      <h2>Personal profile</h2>
      <p>Manage your account details</p>
    </div>
  </div>

  <!-- Card -->
  <div class="card">
    <div class="corner-tr"></div>
    <div class="corner-bl"></div>

    <div class="card-top">
      <span>Account information</span>
      <button class="edit-btn" id="editBtn" onclick="toggleEdit()">
        <span id="editLabel">Edit</span>
      </button>
    </div>

    <div class="card-body">

      <!-- Messages PHP -->
      <div id="msg">
        <?php
          if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
              case "empty_input":           echo "<p class='msg'><span class='error'>Remplissez tous les champs !</span></p>"; break;
              case "invalid_uid":           echo "<p class='msg'><span class='error'>Nom d'utilisateur invalide !</span></p>"; break;
              case "passwords_dont_match":  echo "<p class='msg'><span class='error'>Les mots de passe ne correspondent pas !</span></p>"; break;
              case "stmtfailed":            echo "<p class='msg'><span class='error'>Erreur, réessayez !</span></p>"; break;
              case "username_taken":        echo "<p class='msg'><span class='error'>Nom d'utilisateur déjà pris !</span></p>"; break;
              case "none":                  echo "<p class='msg'><span class='success'>Profil mis à jour !</span></p>"; break;
            }
          }
        ?>
      </div>

      <p class="section-label">Identity</p>

      <form action="includes/manage_profile.inc.php" method="POST">

        <?php echo "<input name='id' type='hidden' value='$memberID'/>"; ?>

        <div class="field">
          <label>Username</label>
          <span class="field-icon">◈</span>
          <?php echo "<input id='username' name='username' type='text' value='$username' minlength='5' maxlength='12' disabled />"; ?>
          <div class="gold-bar"></div>
          <p class="hint">5 – 12 characters</p>
        </div>

        <div class="field">
          <label>Email address</label>
          <span class="field-icon">◇</span>
          <?php echo "<input id='email' name='email' type='email' value='$email' disabled />"; ?>
          <div class="gold-bar"></div>
        </div>

        <!-- Divider -->
        <div class="divider">
          <span class="line"></span>
          <span class="diamond"></span>
          <span class="line"></span>
        </div>

        <p class="section-label">Security</p>

        <div class="pw-row">
          <div class="field">
            <label>New password</label>
            <span class="field-icon">◆</span>
            <input id="pwd" name="pwd" type="password" placeholder="••••••••" minlength="8" maxlength="20" disabled />
            <div class="gold-bar"></div>
            <p class="hint">8 – 20 characters</p>
          </div>
          <div class="field">
            <label>Confirm</label>
            <span class="field-icon">◆</span>
            <input id="repeat_pwd" name="repeat_pwd" type="password" placeholder="••••••••" maxlength="20" disabled />
            <div class="gold-bar"></div>
          </div>
        </div>

        <button type="submit" name="update" class="submit-btn" id="submitBtn" disabled>
          Save changes
        </button>

      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<script>
  let editing = false;
  const fields    = ['username', 'email', 'pwd', 'repeat_pwd'];
  const editBtn   = document.getElementById('editBtn');
  const editLabel = document.getElementById('editLabel');
  const submitBtn = document.getElementById('submitBtn');

  function toggleEdit() {
    editing = !editing;
    fields.forEach(id => document.getElementById(id).disabled = !editing);
    submitBtn.disabled = !editing;
    if (editing) {
      editLabel.textContent = 'Cancel';
      editBtn.classList.add('active');
      document.getElementById('username').focus();
    } else {
      editLabel.textContent = 'Edit';
      editBtn.classList.remove('active');
    }
  }

  /* Fade out PHP messages after 3.5s */
  const msg = document.getElementById('msg');
  if (msg && msg.textContent.trim() !== '') {
    setTimeout(() => {
      msg.style.transition = 'opacity 0.8s';
      msg.style.opacity = '0';
    }, 3500);
  }
</script>
</body>
</html>