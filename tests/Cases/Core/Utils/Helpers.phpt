<?php declare(strict_types = 1);

/**
 * Test: Utils\Helpers
 */

require_once __DIR__ . '/../../../bootstrap.php';

use Apitte\Core\Exception\Logical\InvalidArgumentException;
use Apitte\Core\Utils\Helpers;
use Tester\Assert;

// Helpers::slashless
test(function (): void {
	Assert::equal('/', Helpers::slashless('/'));
	Assert::equal('/', Helpers::slashless('//'));
	Assert::equal('/', Helpers::slashless('/////'));
	Assert::equal('/foo', Helpers::slashless('/foo'));
	Assert::equal('/foo', Helpers::slashless('//foo'));
	Assert::equal('/foo/', Helpers::slashless('/foo/'));
	Assert::equal('/foo/', Helpers::slashless('//foo//'));
});

// Helpers::callback
test(function (): void {
	Assert::type('callable', Helpers::callback([Helpers::class, 'callback']));

	Assert::exception(static function (): void {
		Assert::type('callable', Helpers::callback([Helpers::class, 'fake']));
	}, InvalidArgumentException::class);
});
