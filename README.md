The date Drupal 7 module as a case study for unit testing
-----

This repo was originally copied from the 7.x-2.10 version of [date](https://www.drupal.org/project/date), and corresponds the to the tag `initial`.

[![CircleCI](https://circleci.com/gh/alberto56/presentation_lets_unit_test_date.svg?style=svg)](https://circleci.com/gh/alberto56/presentation_lets_unit_test_date)

Other tags
-----

 * `initial-test`: We refactored a part of a large function to make it testable. To run it, install Docker and run `./src/test.sh`
 * `ci`: Added code to run tests on CircleCI.
 * `provider`: Added a data provider.
 * `provider-multiple`: Added more data to data providers.
 * `non-pure`: Refactored a non-pure function.
 * `mock-stub`: Use mocking and stubbing of external function calls.
 * `exception`: Testing exceptions.
 * `expectations`: Testing expectations.
