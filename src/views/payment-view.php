<table>
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($payments as $payment): ?>
        <th scope="row"><?= $payment['name'] ?></th>
        <td>
            <?= $payment['payment'] ?>
            <?php endforeach ?>
      </td>
    </tr>
    <tr>
      <th scope="row">
            <th scope="row"><?= $payment['name'] ?></th>
      </th>
      <td>
            <?= $payment['payment'] ?>
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th scope="row">Totals</th>
      <td>3 000
        <?php
        function array_multisum(array $payments): float {
            $sum = array_sum($payments);
            foreach ($payments as $payment) {
                $sum += is_array($payment) ? array_multisum($payment) : 0;
            }
            return $sum;
        }
        echo array_multisum($payments);
        ?>
      </td>
    </tr>
  </tfoot>
</table>
