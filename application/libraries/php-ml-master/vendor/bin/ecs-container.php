#!/usr/bin/env sh

dir=$(cd "${0%[/\\]*}" > /dev/null; cd "../symplify/easy-coding-standard/bin" && pwd)

if [ -d /proc/cygdrive ] && [[ $(which php) == $(readlink -n /proc/cygdrive)/* ]]; then
   # We are in Cgywin using Windows php, so the path must be translated
   dir=$(cygpath -m "$dir");
fi

"${dir}/ecs-container.php" "$@"
