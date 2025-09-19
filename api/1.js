// api/proxy.js
export default async function handler(req, res) {
  const targetUrl = "http://xott.live:8080/live/Fahad/1234/380932.m3u8";

  try {
    const response = await fetch(targetUrl, {
      headers: {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
        "Referer": "http://xott.live/",
      },
    });

    if (!response.ok) {
      res.status(response.status).send("Error fetching stream");
      return;
    }

    const text = await response.text();


    res.status(200).send(text);
  } catch (error) {
    res.status(500).send("Server error: " + error.message);
  }
}
