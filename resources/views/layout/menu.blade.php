<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('acceuil') ? 'active' : ''}} " href="/acceuil">Acceuil</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('inscription')? 'active':" "}}" href="/inscription">inscription</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('connexion') ? 'active' : ''}}" href="/connexion">connexion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('contact') ? 'active' : ''}}" href="/contact">contact</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('profil') ? 'active' : ''}}" href="/profil">mon profil</a>
    </li>
</ul>

