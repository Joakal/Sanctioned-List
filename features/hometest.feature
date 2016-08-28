Feature:
In order to prove that Behat works as intended
We want to test the home page for a phrase

Scenario: Root Test
When I go to the homepage
Then I should see "Sanction Search"
