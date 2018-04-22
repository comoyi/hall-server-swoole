#!/bin/bash

pid_file="server.pid"

# color
color_reset='\033[0m'
color_red='\033[1;31m'
color_green='\033[1;32m'
color_yellow='\033[1;33m'
color_blue='\033[1;34m'

start() {
    if [ -f "${pid_file}" ]; then
        last_pid=`cat "${pid_file}"`
        echo "Already running [pid: ${last_pid}]. Please stop first."
        exit 1
    fi
    nohup php ../server/server.php >> ../log/server.log 2>&1 &
    pid=$!
    echo "${pid}" > ${pid_file}
    exit;
}

stop() {
    if [ ! -f "${pid_file}" ]; then
        echo "No pid file found."
        exit 2
    fi
    last_pid=`cat ${pid_file}`
    printf "${color_yellow}"
    ps -f -p ${last_pid}
    printf "${color_reset}"
    printf "${color_yellow}> Kill process ${last_pid}? [y/n]: ${color_reset}"
    read confirm
    if [ "y" != "${confirm}" ]; then
        echo "Cancelled."
        exit
    fi

    kill "${last_pid}"
    if [ "0" != "$?" ]; then
        echo "Kill process failed."
        exit 3
    fi

    rm -f "${pid_file}"
    if [ "0" != "$?" ]; then
        echo "Delete pid file failed."
        exit 4
    fi
}

reload() {
    if [ ! -f "${pid_file}" ]; then
        echo "No pid file found."
        exit 3
    fi
    last_pid=`cat ${pid_file}`
    printf "${color_yellow}"
    ps -f -p ${last_pid}
    printf "${color_reset}"
    printf "${color_yellow}> Reload ${last_pid}? [y/n]: ${color_reset}"
    read confirm
    if [ "y" != "${confirm}" ]; then
        echo "Cancelled."
        exit
    fi

    kill -USR1 "${last_pid}"
    if [ "0" != "$?" ]; then
        echo "Reload failed."
        exit 4
    fi
}

case $1 in
    start)
        start
        ;;
    stop)
        stop
        ;;
    reload)
        reload
        ;;
    restart)
        stop
        start
        ;;
    *)
esac
