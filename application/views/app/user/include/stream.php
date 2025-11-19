<div class="col-12 col-lg-12 remote-playerlist">

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Viewer - Video Only</title>
      <style>
            html, body {
              margin: 0;
              padding: 0;
              height: 100%;
              overflow: hidden;
              background: black;
            }
            #root {
              width: 100vw;
              height: 100vh;
            }
            video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
        }
        #ZegoRoomFooter {
            display: none;
        }
        


        .betting-secton.wait .enimate-coin {
          top: calc(var(--top, 0px) + 60px);
              display: none;
        }



        .result-modal.show {display: block;}
        .result-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99999;
            display: none;
        }
        .result-modal-body {
            text-align: center;
            padding: 20px 20px;
            height: 250px;
            display: grid;
            width: 100%;
            align-items: center;
        }
        .result-modal-result .number-color {
            width: 100px !important;
            height: 100px !important;
            font-size: 50px;
        }
        .result-win p, .result-lose p {
            margin: 0;
            text-transform: uppercase;
        }
        .result-win h2, .result-lose h2 {
            font-size: 45px;
            font-weight: bold;
            color: gold;
        }
        .result-win, .result-lose{
            display: none;
        }
        .result-modal.show.win .result-win{display: block;}
        .result-modal.show.lose .result-lose{display: block;}

      </style>

    </head>
    <body>
      <div id="root"></div>

      <script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>
      <script>
        window.onload = function () {
          const urlParams = new URLSearchParams(window.location.search);
          const roomID = urlParams.get('roomID') || "demoRoom";

          const userID = "viewer_" + Math.floor(Math.random() * 10000);
          const userName = "Viewer_" + userID;

          const appID = 906988945;
          const serverSecret = "4a901db0f6009cc505f7697aefa38dec";

          const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(
            appID,
            serverSecret,
            roomID,
            userID,
            userName
          );

          const zp = ZegoUIKitPrebuilt.create(kitToken);

          zp.joinRoom({
            container: document.getElementById("root"),
            scenario: {
              mode: ZegoUIKitPrebuilt.LiveStreaming,
              config: {
                role: ZegoUIKitPrebuilt.Audience,
              },
            },

            // Permissions
            turnOnCameraWhenJoining: false,
            turnOnMicrophoneWhenJoining: false,

            // Remove all UI elements
            showPreJoinView: false,
            showTextChat: false,
            showUserList: false,
            showLayoutButton: false,
            showScreenSharingButton: false,
            showAudioVideoSettingsButton: false,
            showLeaveRoomButton: false,
            showRoomTimer: false,
            showMicrophoneToggleButton: false,
            showCameraToggleButton: false,
            showMyCameraToggleButton: false,
            showSoundWaveInRoom: false,
            showRoomDetailsButton: false,
          });
        };
      </script>
    </body>
    </html>

    <!-- <video autoplay muted loop><source src="video.mp4" type="video/mp4"></video> -->
</div>