<h1>🚀 User Module Installation Guide</h1>
<p>A step-by-step guide to installing and configuring the <strong>ddmtechdev/user</strong> module in your Yii2 application.</p>

<hr>

<h2>📌 Installation Steps</h2>

<h3>1️⃣ Install the Package</h3>
<p>Run the following command to install the package via Composer:</p>
<pre><code>composer require ddmtechdev/user:@dev</code></pre>

<h3>2️⃣ Run Migrations</h3>
<p>Apply the necessary database migrations:</p>
<pre><code>php yii migrate/up --migrationPath=@vendor/ddmtechdev/user/migrations</code></pre>

<h3>3️⃣ Configure the Application</h3>
<p>Modify your <code>common/config/main.php</code> file and update the <code>components</code> and <code>modules</code> section:</p>
<pre><code>
'components' => [
    'user' => [
        'class' => 'yii\web\User',
        'identityClass' => 'ddmtechdev\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl' => ['user/auth/login'], // Set the login route
    ],
    ...
],
'modules' => [
    'user' => [
        'class' => 'ddmtechdev\user\Module',
    ],
    ...
],
</code></pre>

<h3>4️⃣ Add Repository to Composer</h3>
<p>To ensure the correct repository is accessible, open <code>composer.json</code> and add the following inside the <code>"repositories"</code> array:</p>
<pre><code>
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ddmtechdev/user.git"
    }
    ...
]
</code></pre>

<hr>

<h2>✅ Final Steps</h2>
<ul>
    <li>🔹 <strong>Flush cache</strong> (to apply changes):</li>
    <pre><code>php yii cache/flush-all</code></pre>
    <li>🔹 <strong>Restart the web server</strong> (if necessary)</li>
    <li>🔹 <strong>Access the user module</strong> via your configured routes</li>
</ul>
