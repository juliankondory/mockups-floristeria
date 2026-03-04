<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <?php
    // Verificar que exista el menú en sesión
    if (isset($_SESSION['sidebar_menu']) && is_array($_SESSION['sidebar_menu'])):
        foreach ($_SESSION['sidebar_menu'] as $item):
            if (!empty($item['children'])):
                // Módulo padre con hijos - renderizar como dropdown
                $uniqueId = 'nav-' . $item['nombre'];
    ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#<?= $uniqueId ?>" data-bs-toggle="collapse" href="#">
            <i class="bi <?= $item['icono'] ?>"></i><span><?= $item['titulo'] ?></span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="<?= $uniqueId ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <?php foreach ($item['children'] as $child): ?>
            <li>
              <a href="<?= $child['ruta'] ?>">
                <i class="bi bi-circle"></i><span><?= $child['titulo'] ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </li>
    <?php
            else:
                // Módulo sin hijos - renderizar como link normal
    ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= $item['ruta'] ?>">
            <i class="bi <?= $item['icono'] ?>"></i>
            <span><?= $item['titulo'] ?></span>
          </a>
        </li>
    <?php
            endif;
        endforeach;
    else:
        // Fallback si no hay menú en sesión
    ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="index">
            <i class="bi bi-grid"></i>
            <span>Inicio</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="users-profile">
            <i class="bi bi-person"></i>
            <span>Perfil</span>
          </a>
        </li>
    <?php endif; ?>

  </ul>

</aside>
