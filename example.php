<?php
include __DIR__ . '/vendor/autoload.php';

use Webard\MjmlProject\Project;

$project = new Project();

$project->addFile('header', '<mj-section>

<mj-column>
  <mj-text>
    This is the header
  </mj-text>
</mj-column>

</mj-section>');

$project->addFile('footer', '<mj-section>

<mj-column>
  <mj-text>
    This is the header
  </mj-text>
</mj-column>

</mj-section>');


$project->addFile('index', '<mjml>

<mj-head>

  <mj-attributes>
    <mj-text align="center" color="#555" />
  </mj-attributes>

</mj-head>

<mj-body background-color="#eee">

  <mj-include path="header" />

  <mj-section background-color="#fff">

    <mj-column>
      <mj-text align="center">
        <h2>MJML Rocks!</h2>
      </mj-text>
    </mj-column>

    <mj-column>
      <mj-image width="200" src="http://placehold.it/200x200"></mj-image>
    </mj-column>

  </mj-section>

  <mj-include path="footer" />

</mj-body>

</mjml>');

echo $project->render('index');
