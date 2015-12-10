{PHP $CAT=CATBC($cid,1)}
{LOOP $CAT $cat}
{header('Location:'.$cat['url'])}
{exit()}
{/LOOP}