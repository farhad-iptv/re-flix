// api/proxy.js
export default async function handler(req, res) {
  const targetUrl = "http://opplex.tv:8080/live/Mujahid.pak%402023/Mujahid%402017/167573.m3u8";

  try {
    const response = await fetch(targetUrl, {
      headers: {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
        "Referer": "http://opplex.tv/",
      },
    });

    if (!response.ok) {
      const errorText = await response.text();
      res.status(response.status).send(`Fetch failed: ${response.status} ${response.statusText}\n\n${errorText}`);
      return;
    }

    const text = await response.text();


    res.status(200).send(text);
  } catch (error) {
    res.status(500).send("Server error: " + error.message);
  }
}
