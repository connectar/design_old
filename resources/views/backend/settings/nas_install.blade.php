<!DOCTYPE html>
<html>

<head>
    <title>صفحة الأكواد</title>
    <link rel="stylesheet" href="{{ asset('prism.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            /* لون الخلفية الحالي */
        }

        /* تعديل الخلفية هنا */
        /* body {
      background-color: #e9e9e9;  لون مخصص
      background-image: url('background.jpg');  صورة كخلفية
      background-repeat: no-repeat;
      background-size: cover;
    } */

        .container {
            text-align: center;
            margin-bottom: 20px;
        }

        pre {
            white-space: pre-wrap;
            padding: 10px;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
            font-size: 14px;
            margin-bottom: 20px;
            overflow-x: auto;
            /* تمرير أفقي */
            overflow-y: auto;
            /* تمرير عمودي */
            max-width: 700px;
            /* تحديد عرض الجدول */
            max-height: 200px;
            /* تحديد ارتفاع الجدول */
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            display: none;
            z-index: 9999;
        }

        .footer {
            margin-top: auto;
            padding: 20px;
            background-color: #f7f7f7;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <script src="{{ asset('prism.js') }}"></script>
    <div class="container">
        <h1>يجب تغير اسم كارت الخروج الى </h1>
        <h1>lan</h1>
        <h1>احرف سمول وليس كابتل</h1>

        <h1>تسطيب هوت سبوت وبرودبند</h1>

        <div class="code-container">
            <pre id="codeBlock1">
        <code class="language-routero">/ip address
add address=10.0.0.1/16 disabled=no interface=lan network=10.0.0.0
/ip pool
add name=ppp_pool1 ranges=10.0.10.1-10.0.19.254
add name=dhcp_pooll ranges=10.0.0.100-10.0.9.254
/ip firewall filter
/ip firewall nat
add action=masquerade chain=srcnat comment="masquerade hotspot network" disabled=no src-address=10.0.0.0/16
/ip dns
set allow-remote-requests=yes cache-max-ttl=1w cache-size=2048KiB \
    max-udp-packet-size=2048 servers=8.8.8.8,8.8.4.4
/ppp profile
set *0 local-address=dhcp_pooll remote-address=ppp_pool1
set *FFFFFFFE local-address=dhcp_pooll remote-address=ppp_pool1

/ppp profile
set 0 change-tcp-mss=yes local-address=dhcp_pooll name=default only-one=default \
    remote-address=ppp_pool1 use-compression=default use-encryption=default \
    use-ipv6=yes use-mpls=default use-vj-compression=default
set 1 change-tcp-mss=yes name=default-encryption only-one=default \
    use-compression=default use-encryption=yes use-ipv6=yes use-mpls=default \
    use-vj-compression=default
/interface pppoe-server server
add authentication=pap,chap default-profile=default disabled=no interface=lan \
    keepalive-timeout=10 max-mru=1480 max-mtu=1480 max-sessions=0 mrru=disabled \
    one-session-per-host=no service-name=CONNECT4AR

/ppp aaa
set accounting=yes interim-update=2m use-radius=yes
/ppp secret
add caller-id="" disabled=no limit-bytes-in=0 limit-bytes-out=0 name= \
    password= profile=default-encryption routes="" service=any
interface pppoe-server server
add authentication=pap,chap disabled=no interface=lan keepalive-timeout=100 \
    max-mru=1480 max-mtu=1480 service-name=CONNECT4AR
/ ip hotspot profile set [find name!=0] use-radius=yes
/ ip hotspot profile set [find name!=0] dns-name="" hotspot-address=10.0.0.1 html-directory=hotspot http-cookie-lifetime=3d http-proxy=0.0.0.0:0 login-by=mac,cookie,http-chap,http-pap

/ip dhcp-server
remove [find name="dhcp1"]
add address-pool=dhcp_pooll authoritative=after-2sec-delay bootp-support=\
    static disabled=no interface=lan lease-time=3d name=dhcp1

/ip dhcp-server network remove [find]
/ip dhcp-server network
add address=10.0.0.0/16 comment="hotspot network" gateway=10.0.0.1

/interface pptp-server server
set authentication=mschap1,mschap2 default-profile=default enabled=yes \
    keepalive-timeout=30 max-mru=1460 max-mtu=1460 mrru=disabled
/ip address


/ip hotspot profile
set [ find default=yes ] dns-name="" hotspot-address=10.0.0.1 html-directory=hotspot http-cookie-lifetime=3d http-proxy=0.0.0.0:0 login-by=\
    mac,cookie,http-chap,http-pap mac-auth-password="" name=default nas-port-type=wireless-802.11 radius-accounting=yes radius-default-domain="" \
    radius-interim-update=2m radius-location-id="" radius-location-name="" radius-mac-format=XX:XX:XX:XX:XX:XX rate-limit="" smtp-server=0.0.0.0 \
    split-user-domain=no use-radius=yes
add dns-name="" hotspot-address=10.0.0.1 html-directory=hotspot http-cookie-lifetime=3d http-proxy=0.0.0.0:0 login-by=mac,cookie,http-chap,http-pap \
    mac-auth-password="" name=hsprof1 nas-port-type=wireless-802.11 radius-accounting=yes radius-default-domain="" radius-interim-update=1m radius-location-id=\
    "" radius-location-name="" radius-mac-format=XX:XX:XX:XX:XX:XX rate-limit="" smtp-server=0.0.0.0 split-user-domain=no use-radius=yes
/ip hotspot
add address-pool=dhcp_pooll addresses-per-mac=1 disabled=no idle-timeout=5m interface=lan keepalive-timeout=none name=hotspot1 profile=default
/ip hotspot user profile
set [ find default=yes ] idle-timeout=none keepalive-timeout=2m name=default shared-users=3 status-autorefresh=1m transparent-proxy=no
/ip hotspot service-port
set ftp disabled=no ports=21
/system scheduler
/ip hotspot walled-garden ip
add action=accept comment=connect_4arPro disabled=no dst-address=172.93.102.72 !dst-address-list !dst-port \
    !protocol !src-address !src-address-list
add action=accept comment=connect_url disabled=no !dst-address dst-address-list=connect4ar.com !dst-port \
    !protocol !src-address !src-address-list
	/system scheduler
add interval=10m name=UP-ROOL on-event="/ip firewall filter move [find comment=\"Connect4ar_devices\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices1\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices2\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices3\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"connect_4arPro\"] destination=3\r\
    \n" policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-date=may/25/2023 start-time=\
    00:00:00
	/ip firewall filter
add action=accept chain=input comment=Connect4ar_devices1 protocol=icmp
add action=accept chain=forward comment=Connect4ar_devices2 src-address=172.30.1.1
add action=accept chain=forward comment=Connect4ar_devices3 dst-address=172.30.1.1
/ip firewall filter

        </code>
      </pre>
        </div>

        <button onclick="copyCode(1)">نسخ الكود 1</button>
    </div>
    <h1>====================================================</h1>
    <h1>اكواد برودبند فقط</h1>
    <div class="container">
        <div class="code-container">
            <pre id="codeBlock2">
        <code class="language-routero">
/ip address
add address=10.0.0.1/16 disabled=no interface=lan network=10.0.0.0
/ip pool
add name=ppp_pool1 ranges=10.0.10.1-10.0.19.254
add name=dhcp_pooll ranges=10.0.0.100-10.0.9.254
/ip firewall filter
/ip firewall nat
add action=masquerade chain=srcnat comment="masquerade hotspot network" disabled=no src-address=10.0.0.0/16
/ip dns
set allow-remote-requests=yes cache-max-ttl=1w cache-size=2048KiB \
    max-udp-packet-size=2048 servers=8.8.8.8,8.8.4.4
/ppp profile
set *0 local-address=dhcp_pooll remote-address=ppp_pool1
set *FFFFFFFE local-address=dhcp_pooll remote-address=ppp_pool1

/ppp profile
set 0 change-tcp-mss=yes local-address=dhcp_pooll name=default only-one=default \
    remote-address=ppp_pool1 use-compression=default use-encryption=default \
    use-ipv6=yes use-mpls=default use-vj-compression=default
set 1 change-tcp-mss=yes name=default-encryption only-one=default \
    use-compression=default use-encryption=yes use-ipv6=yes use-mpls=default \
    use-vj-compression=default
/interface pppoe-server server
add authentication=pap,chap default-profile=default disabled=no interface=lan \
    keepalive-timeout=10 max-mru=1480 max-mtu=1480 max-sessions=0 mrru=disabled \
    one-session-per-host=no service-name=CONNECT4AR

/ppp aaa
set accounting=yes interim-update=2m use-radius=yes
/ppp secret
add caller-id="" disabled=no limit-bytes-in=0 limit-bytes-out=0 name= \
    password= profile=default-encryption routes="" service=any
interface pppoe-server server
add authentication=pap,chap disabled=no interface=lan keepalive-timeout=100 \
    max-mru=1480 max-mtu=1480 service-name=CONNECT4AR
	/system scheduler
add interval=10m name=UP-ROOL on-event="/ip firewall filter move [find comment=\"Connect4ar_devices\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices1\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices2\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"Connect4ar_devices3\"] destination=0\r\
    \n/ip firewall filter move [find comment=\"connect_4arPro\"] destination=3\r\
    \n" policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-date=may/25/2023 start-time=\
    00:00:00
/ip firewall filter
add action=accept chain=input comment=Connect4ar_devices1 protocol=icmp
add action=accept chain=forward comment=Connect4ar_devices2 src-address=172.30.1.1
add action=accept chain=forward comment=Connect4ar_devices3 dst-address=172.30.1.1
/ip firewall filter
        </code>
      </pre>
        </div>

        <button onclick="copyCode(2)">نسخ الكود 2</button>
    </div>

    <div class="alert" id="alertMessage"></div>

    <div class="footer">
        <p>جميع الحقوق محفوظة &copy; شركة كونكت فور عرب</p>
    </div>

    <script>
        function copyCode(blockNumber) {
            var codeBlock = document.getElementById(`codeBlock${blockNumber}`);
            var codeText = codeBlock.innerText;

            // navigator.clipboard.writeText(codeText)
            //     .then(() => {
            //         const alertMessage = document.getElementById("alertMessage");
            //         alertMessage.innerText = "تم نسخ الكود بنجاح!";
            //         alertMessage.style.display = "block";
            //         setTimeout(function() {
            //             alertMessage.style.display = "none";
            //         }, 3000);
            //     })
            //     .catch((error) => {
            //         console.error("حدث خطأ أثناء النسخ:", error);
            //     });
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = codeText;
            document.body.appendChild(tempInput);
            tempInput.select();
            try {
                var successful = document.execCommand("copy", false, null);
                if (successful) {
                    const alertMessage = document.getElementById("alertMessage");
                    alertMessage.innerText = "تم نسخ الكود بنجاح!";
                    alertMessage.style.display = "block";
                    setTimeout(function() {
                        alertMessage.style.display = "none";
                    }, 3000);
                }
            } catch (err) {
                console.error("حدث خطأ أثناء النسخ:", error);
            }
        }
    </script>
</body>

</html>
