<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use verbb\navigation\elements\Node;
use verbb\navigation\Navigation;
use verbb\navigation\nodetypes\CustomType;

/**
 * Adds a "Referral Form" link below "Contact us" in the slide-out menu and footer.
 */
class m261008_000000_add_referral_form_nav_nodes extends Migration
{
    private const NAV_HANDLES = ['slideOut', 'footer1'];
    private const TITLE = 'Referral Form';
    private const URL = '/referral';

    public function safeUp(): bool
    {
        $structures = Craft::$app->getStructures();

        foreach (self::NAV_HANDLES as $handle) {
            $nav = Navigation::$plugin->getNavs()->getNavByHandle($handle);

            if (!$nav) {
                echo "    > nav '$handle' not found, skipping\n";
                continue;
            }

            if ($this->findNodes($handle)) {
                echo "    > nav '$handle' already has a referral link, skipping\n";
                continue;
            }

            $node = new Node();
            $node->title = self::TITLE;
            $node->navId = $nav->id;
            $node->type = CustomType::class;
            $node->url = self::URL;

            // Saving appends the node to the end of the nav
            if (!Craft::$app->getElements()->saveElement($node)) {
                echo "    > couldn't save node for '$handle': " . implode(', ', $node->getFirstErrors()) . "\n";
                return false;
            }

            // "Contact us" is normally last already, but don't rely on it
            $contact = Node::find()->nav($handle)->title('Contact us')->level(1)->status(null)->one();

            if ($contact) {
                $structures->moveAfter($nav->structureId, $node, $contact);
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        foreach (self::NAV_HANDLES as $handle) {
            foreach ($this->findNodes($handle) as $node) {
                Craft::$app->getElements()->deleteElement($node, true);
            }
        }

        return true;
    }

    /**
     * @return Node[]
     */
    private function findNodes(string $handle): array
    {
        return array_filter(
            Node::find()->nav($handle)->status(null)->all(),
            fn(Node $node) => $node->getRawUrl() === self::URL,
        );
    }
}
