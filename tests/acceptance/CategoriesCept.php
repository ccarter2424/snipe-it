<?php
$I = new AcceptanceTester($scenario);
AcceptanceTester::test_login($I);
$I->am('logged in user');
$I->wantTo('ensure that the categories listing page loads without errors');
$I->lookForwardTo('seeing it load without errors');
$I->amOnPage('/admin/settings/categories');
$I->waitForElement('.table', 10); // secs
$I->seeNumberOfElements('tr', [1,100]);
$I->seeInTitle('Categories');
$I->see('Categories');
$I->seeInPageSource('admin/settings/categories/create');
$I->dontSee('Categories', '.page-header');
$I->see('Categories', 'h1.pull-left');

/* Create Form */
$I->wantTo('ensure that the create category form loads without errors');
$I->lookForwardTo('seeing it load without errors');
$I->click(['link' => 'Create New']);
$I->amOnPage('/admin/settings/categories/create');
$I->dontSee('Create Category', '.page-header');
$I->see('Create Category', 'h1.pull-left');
$I->dontSee('&lt;span class=&quot;');

$I->fillField('name', \App\Helpers\Helper::generateRandomString(15));
$I->selectOption('form select[name=category_type]', 'Asset');
$I->click('Save');
$I->dontSee('&lt;span class=&quot;');
$I->dontSeeElement('.alert-danger');
