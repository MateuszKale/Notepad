
<div>
  <section>
    <div class="message">
      <?php 
      if (!empty($params['error'])) { 
        switch(!empty($params['error'])){
          case "missingNoteId":
            echo "Niepoprawny identyfikator notatki";
            break;
          case 'noteNotFound':
            echo "Notatka nie została znaleziona";
            break;
          }
        }  
      ?>
    </div>
    <div class="message">
      <?php if (!empty($params['before'])) { 
          switch(!empty($params['before'])){
            case 'created':
              echo "Notatka została utworzona";
              break;
          }
        }  
      ?>
    </div>

    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Data</th>
            <th>Opcje</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <?php foreach ($params['notes'] ?? [] as $note): ?>
            <tr>
              <td><?php echo (int) $note['id'] ?></td>
              <td><?php echo htmlentities($note['title']) ?></td>
              <td><?php echo htmlentities($note['created']) ?></td>
              <td>
                <a href="/?action=show&id=<?php echo (int) $note['id'] ?>"> 
                <button> Szczegóły </button>
                </a>
              </td>
            </tr> 
            <?php endforeach; ?>
        </tbody>
    </div>
  </section>
</div>

