#
# Pandora Agents
#
%define name        pandora_agents
%define version	    1.2.0
Summary:            Pandora Agents
Name:               %{name}
Version:            %{version}
Release:            1
License:            GPL
Vendor:             Sancho Lerena <sancho.lerena@artica.es>
Source0:            %{name}-%{version}.tar.gz
URL:                http://pandora.sf.net
Group:              Networking/Security
Packager:           Manuel Arostegui <marostegui@artica.es>
Prefix:             /opt
BuildRoot:          %{_tmppath}/%{name}-%{version}-buildroot
BuildArchitectures: noarch
Requires:	    openssh-client coreutils
AutoReq:            0
Provides:           %{name}-%{version}

%description
Pandora agents are based on native languages in every platform: scripts that can be written in any
language. It’s possible to reproduce any agent in any programming language and can be extended
without difﬁculty the existing ones in order to cover aspects not taken into account up to the moment.
These scripts are formed by modules that each one gathers a "chunk" of information. Thus, every agent
gathers several "chunks" of information; this one is organized in a data set and stored in a single ﬁle,
called data ﬁle.

%prep
#rm -rf $RPM_BUILD_ROOT

%setup -q -n linux

%build

%install
rm -rf $RPM_BUILD_ROOT
mkdir -p $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}
mkdir -p $RPM_BUILD_ROOT/usr/
mkdir -p $RPM_BUILD_ROOT/usr/share/
mkdir -p $RPM_BUILD_ROOT/usr/share/man
mkdir -p $RPM_BUILD_ROOT/usr/share/man/man1
mkdir -p $RPM_BUILD_ROOT/usr/
mkdir -p $RPM_BUILD_ROOT/usr/bin/
mkdir -p $RPM_BUILD_ROOT/etc/
mkdir -p $RPM_BUILD_ROOT/etc/pandora/
mkdir -p $RPM_BUILD_ROOT/usr/local/etc/pandora/temp
mkdir -p $RPM_BUILD_ROOT/var/spool/pandora/
mkdir -p $RPM_BUILD_ROOT/var/spool/pandora/data_out
mkdir -p $RPM_BUILD_ROOT/var/log/pandora/
cp -aRf * $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}
mv $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/pandora_agent.sh $RPM_BUILD_ROOT/usr/bin/pandora_agent
mv $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/pandora_agent_daemon $RPM_BUILD_ROOT/usr/bin/pandora_agent_daemon
mv $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/pandora_agent.conf $RPM_BUILD_ROOT/etc/pandora/pandora_agent.conf
mv $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/pandora_user.conf $RPM_BUILD_ROOT/etc/pandora/pandora_user.conf
cp pandora.1 $RPM_BUILD_ROOT/usr/share/man/man1/
cp pandora_agents.1 $RPM_BUILD_ROOT/usr/share/man/man1/
if [ -f $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/%{name}.spec ] ; then
    rm $RPM_BUILD_ROOT%{prefix}/%{name}-%{version}-%{release}/%{name}.spec
fi

%clean
rm -rf $RPM_BUILD_ROOT
%post
echo "Pandora Agent has been place under /usr/bin/"
echo "Pandora Agent configuration file is /etc/pandora/pandora_agent.conf"
%files
%defattr(700,pandora,pandora)
/usr/bin/pandora_agent_daemon
/usr/bin/pandora_agent
%defattr(600,pandora,pandora)
/var/log/pandora/
/var/spool/pandora/
%defattr(755,pandora,pandora)
/etc/pandora/pandora_user.conf
/etc/pandora/pandora_agent.conf
%docdir %{prefix}/%{name}-%{version}-%{release}/docs
%{prefix}/%{name}-%{version}-%{release}
%{_mandir}/man1/pandora.1.gz
%{_mandir}/man1/pandora_agents.1.gz
