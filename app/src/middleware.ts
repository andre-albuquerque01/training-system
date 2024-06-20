import { type NextRequest, NextResponse } from 'next/server'

export async function middleware(request: NextRequest) {
  const token = request.cookies.get('token')?.value
  const authentication =
    token !== undefined && token.length >= 49 && token.length <= 53

  if (
    (!authentication && request.nextUrl.pathname.startsWith('dashboard')) ||
    request.nextUrl.pathname.startsWith('training') ||
    request.nextUrl.pathname.startsWith('trainingWorkOut') ||
    request.nextUrl.pathname.startsWith('workOut') ||
    request.nextUrl.pathname.startsWith('user')
  ) {
    return NextResponse.redirect(new URL('/', request.url))
  }
  if (
    (authentication && request.nextUrl.pathname.endsWith('/')) ||
    request.nextUrl.pathname.startsWith('user/recover') ||
    request.nextUrl.pathname.startsWith('user/insert') ||
    request.nextUrl.pathname.startsWith('user/login')
  ) {
    return NextResponse.redirect(new URL('/dashboard', request.url))
  }
  return NextResponse.next()
}
